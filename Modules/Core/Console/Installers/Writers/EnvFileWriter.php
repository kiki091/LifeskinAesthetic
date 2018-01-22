<?php namespace Modules\Core\Console\Installers\Writers;

use Illuminate\Filesystem\Filesystem;
use Dotenv\Dotenv;

class EnvFileWriter
{
    /**
     * @var Filesystem
     */
    private $finder;

    /**
     * @var array
     */
    protected $search = [
        "DB_HOST_FACILE=127.0.0.1",
        "DB_PORT_FACILE=3306",
        "DB_DATABASE_FACILE=homestead",
        "DB_USERNAME_FACILE=homestead",
        "DB_PASSWORD_FACILE=secret",
    ];

    /**
     * @var string
     */
    protected $template = '.env.example';

    /**
     * @var string
     */
    protected $file = '.env';

    /**
     * @param Filesystem $finder
     */
    public function __construct(Filesystem $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @param $name
     * @param $username
     * @param $password
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function write($name, $port, $username, $password, $host)
    {
        $dotenv = new Dotenv(base_path(), $this->template);
        $dotenv->overload();

        $environmentFile = $this->finder->get($this->template);

        $replace = [
            "DB_HOST_FACILE=$host",
            "DB_PORT_FACILE=$port",
            "DB_DATABASE_FACILE=$name",
            "DB_USERNAME_FACILE=$username",
            "DB_PASSWORD_FACILE=$password",
        ];


        $newEnvironmentFile = str_replace($this->search, $replace, $environmentFile);
        $this->finder->put($this->file, $newEnvironmentFile);

    }
}
