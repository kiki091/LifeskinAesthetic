<?php

namespace Modules\Cor\Custom;

use Parsedown;
use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\Routing\UrlGenerator;
use Session;


class FacileForm
{
    protected $view;
    protected $url;
    protected $reserved = ['method', 'url', 'route', 'action', 'files'];
    protected $spoofedMethods = ['DELETE', 'PATCH', 'PUT'];
    protected $skipValueTypes = ['file', 'password', 'checkbox', 'radio'];
    protected $labels = [];
    
    protected $componentPaths = [];
    protected $csrfToken;
    protected $session;

    public function __construct(ViewFactory $view,  UrlGenerator $url, array $options = [])
    {
        $this->url = $url;
        $this->view = $view;
        $this->session = session();
        $this->loadComponentsFrom(Arr::get($options, 'paths', []));
    }


    public function test() {

    }


    /**
     * Render the tag template into HTML.
     *
     * @param  string  $view
     * @param  array  $data
     * @return \Illuminate\Support\HtmlString
     */
    public function renderTag($view, array $data = [])
    {
        $this->view->flushFinderCache();
        return new HtmlString(preg_replace("/[\r\n]{2,}/", "\n\n"
            , $this->view->make($this->componentPaths[0].$view, $data)->render())
        );
    }

    /**
     * Parse the given text into HTML.
     *
     * @param  string  $text
     * @return string
     */
    public static function parse($text)
    {
        $parsedown = new Parsedown;
        return new HtmlString($parsedown->text($text));
    }


    /**
     * Get the component paths.
     *
     * @return array
     */
    protected function componentPaths()
    {
        return array_unique(array_merge($this->componentPaths, [
            'components/',
        ]));
    }

    /**
     * Register new component paths.
     *
     * @param  array  $paths
     * @return void
     */
    public function loadComponentsFrom(array $paths = [])
    {
        $this->componentPaths = $paths;
        if(!sizeof($this->componentPaths))
            $this->componentPaths = $this->componentPaths();
    }

    /*
        MAIN FUNCTION
     */
    public function open(array $options = [])
    {
        $method = array_get($options, 'method', 'post');
        $attributes['method'] = $this->getMethod($method);
        $attributes['action'] = $this->getAction($options);

        $attributes['accept'] = 'UTF-8';

        if (isset($options['files']) && $options['files']) {
            $options['enctype'] = 'multipart/form-data';
        }

        $attributes = array_merge(
          $attributes, array_except($options, $this->reserved)

        );

        list($method, $appendage) = [strtoupper($method), ''];

        if (in_array($method, $this->spoofedMethods)) {
            $attributes['spoofmethod'] = true;
        }

        if ($method != 'GET') {
            $attributes['hidden'] = true;   
        }

        return $this->renderTag('form', $attributes);
    }


    public function close()
    {
        return $this->toHtmlString('</form>');
    }

    public function password($name, $options = [])
    {
        return $this->input('password', $name, '', $options);
    }

    public function email($name, $value = null, $options = [])
    {
        return $this->input('email', $name, $value, $options);
    }

    public function tel($name, $value = null, $options = [])
    {
        return $this->input('tel', $name, $value, $options);
    }

    public function number($name, $value = null, $options = [])
    {
        return $this->input('number', $name, $value, $options);
    }

    public function date($name, $value = null, $options = [])
    {
        if ($value instanceof DateTime) {
            $value = $value->format('Y-m-d');
        }

        return $this->input('date', $name, $value, $options);
    }

    public function datetime($name, $value = null, $options = [])
    {
        if ($value instanceof DateTime) {
            $value = $value->format(DateTime::RFC3339);
        }

        return $this->input('datetime', $name, $value, $options);
    }

    public function time($name, $value = null, $options = [])
    {
        return $this->input('time', $name, $value, $options);
    }


    public function file($name, $options = [])
    {
        return $this->input('file', $name, null, $options);
    }


    public function textarea($name, $value = null, $options = [])
    {
        if (! isset($options['name'])) {
            $options['name'] = $name;
        }

        $options = $this->setTextAreaSize($options);

        $options['id'] = $this->getIdAttribute($name, $options);
        $options['class'] = $this->getClassAttribute($name, $options);

        $value = (string) $this->getValueAttribute($name, $value);
        $options['value'] = $value;

        unset($options['size']);

        return $this->renderTag('textarea', $options);
    }

    public function select($name, $list = [], $selected = null, $options = [])
    {
        $selected = $this->getValueAttribute($name, $selected);

        $options['id'] = $this->getIdAttribute($name, $options);
        $options['class'] = $this->getClassAttribute($name, $options);

        if (! isset($options['name'])) {
            $options['name'] = $name;
        }

        $html = [];
        if (isset($options['placeholder'])) {
            $html[] = $this->placeholderOption($options['placeholder'], $selected);
            unset($options['placeholder']);
        }

        foreach ($list as $value => $display) {
            $html[] = $this->getSelectOption($display, $value, $selected);
        }


        $list = implode('', $html);
        $options['list'] = $list;
        return $this->renderTag('select', $options);
    }

    public function checkbox($name, $value = 1, $checked = null, $options = [])
    {
        return $this->checkable('checkbox', $name, $value, $checked, $options);
    }

    public function radio($name, $value = null, $checked = null, $options = [])
    {
        if (is_null($value)) {
            $value = $name;
        }

        return $this->checkable('radio', $name, $value, $checked, $options);
    }


    /**
     * FUNCTION RELATED
     */
    protected function toHtmlString($html)
    {
        return new HtmlString($html);
    }

    protected function getMethod($method)
    {
        $method = strtoupper($method);

        return $method != 'GET' ? 'POST' : $method;
    }

    protected function getAction(array $options)
    {

        if (isset($options['url'])) {
            return $this->getUrlAction($options['url']);
        }

        if (isset($options['route'])) {
            return $this->getRouteAction($options['route']);
        }

        elseif (isset($options['action'])) {
            return $this->getControllerAction($options['action']);
        }

        return $this->url->current();
    }


    protected function getUrlAction($options)
    {
        if (is_array($options)) {
            return $this->url->to($options[0], array_slice($options, 1));
        }

        return $this->url->to($options);
    }


    protected function getRouteAction($options)
    {
        if (is_array($options)) {
            return $this->url->route($options[0], array_slice($options, 1));
        }

        return $this->url->route($options);
    }

    protected function getControllerAction($options)
    {
        if (is_array($options)) {
            return $this->url->action($options[0], array_slice($options, 1));
        }

        return $this->url->action($options);
    }


    public function token()
    {
        $token = ! empty($this->csrfToken) ? $this->csrfToken : $this->session->token();
        return $this->hidden('_token', $token);
    }

    public function hidden($name, $value = null, $options = [])
    {
        return $this->input('hidden', $name, $value, $options);
    }

    public function input($type, $name, $value = null, $options = [])
    {
        if (!isset($options['name'])) {
            $options['name'] = $name;
        }

        $id = $this->getIdAttribute($name, $options);

        if (! in_array($type, $this->skipValueTypes)) {
            $value = $this->getValueAttribute($name, $value);
        }

        $merge = compact('type', 'value', 'id');
        $options = array_merge($options, $merge);

        return $this->renderTag('input', $options);
    }

    public function getIdAttribute($name, $attributes)
    {
        if (array_key_exists('id', $attributes)) {
            return $attributes['id'];
        }

        if (in_array($name, $this->labels)) {
            return $name;
        }
    }


     public function getClassAttribute($name, $attributes)
    {
        if (array_key_exists('class', $attributes)) {
            return $attributes['class'];
        }

        if (in_array($name, $this->labels)) {
            return $name;
        }
    }

    public function getValueAttribute($name, $value = null)
    {
        if (is_null($name)) {
            return $value;
        }

        if (! is_null($value)) {
            return $value;
        }

    }

    protected function setTextAreaSize($options)
    {
        if (isset($options['size'])) {
            return $this->setQuickTextAreaSize($options);
        }

        $cols = array_get($options, 'cols', 50);
        $rows = array_get($options, 'rows', 10);

        return array_merge($options, compact('cols', 'rows'));
    }

    protected function setQuickTextAreaSize($options)
    {
        $segments = explode('x', $options['size']);

        return array_merge($options, ['cols' => $segments[0], 'rows' => $segments[1]]);
    }

    public function getSelectOption($display, $value, $selected)
    {
        if (is_array($display)) {
            return $this->optionGroup($display, $value, $selected);
        }

        return $this->option($display, $value, $selected);
    }

    protected function optionGroup($list, $label, $selected)
    {
        $html = [];

        foreach ($list as $value => $display) {
            $html[] = $this->option($display, $value, $selected);
        }

        return $this->toHtmlString('<optgroup label="' . $this->html->escapeAll($label) . '">' . implode('', $html) . '</optgroup>');
    }

    protected function option($display, $value, $selected)
    {
        $selected = $this->getSelectedValue($value, $selected);

        $options = ['value' => $value, 'selected' => $selected];

        return $this->toHtmlString("<option value=\"" . $options['value'] . "\" $selected>" . $display . '</option>');
    }

    protected function getSelectedValue($value, $selected)
    {
        if (is_array($selected)) {
            return in_array($value, $selected) ? 'selected' : null;
        }

        return ((string) $value == (string) $selected) ? 'selected' : null;
    }

    protected function placeholderOption($display, $selected)
    {
        $selected = $this->getSelectedValue(null, $selected);

        $options = compact('selected');
        $options['value'] = '';
        return $this->toHtmlString("<option $selected>" . $display . '</option>');
    }

    protected function checkable($type, $name, $value, $checked, $options)
    {
        $checked = $this->getCheckedState($type, $name, $value, $checked);

        if ($checked) {
            $options['checked'] = 'checked';
        }

        return $this->input($type, $name, $value, $options);
    }

    protected function getCheckedState($type, $name, $value, $checked)
    {
        switch ($type) {
            case 'checkbox':
                return $this->getCheckboxCheckedState($name, $value, $checked);

            case 'radio':
                return $this->getRadioCheckedState($name, $value, $checked);

            default:
                return $this->getValueAttribute($name) == $value;
        }
    }

    protected function getCheckboxCheckedState($name, $value, $checked)
    {
        /*
        if (isset($this->session) && ! $this->oldInputIsEmpty() && is_null($this->old($name))) {
            return false;
        }

        if ($this->missingOldAndModel($name)) {
            return $checked;
        }*/

        $posted = $this->getValueAttribute($name, $checked);

        if (is_array($posted)) {
            return in_array($value, $posted);
        } elseif ($posted instanceof Collection) {
            return $posted->contains('id', $value);
        } else {
            return (bool) $posted;
        }
    }

    protected function getRadioCheckedState($name, $value, $checked)
    {
        /*
        if ($this->missingOldAndModel($name)) {
            return $checked;
        }*/

        return $this->getValueAttribute($name) == $value;
    }
}
