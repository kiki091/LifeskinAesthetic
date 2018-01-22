<?php namespace Modules\Core\Console\Installers\Scripts;

use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository as Config;
use Modules\Core\Console\Installers\SetupScript;
use Modules\Core\Console\Installers\Writers\EnvFileWriter;
use PDOException;
use DB;

class ConfigureDatabase implements SetupScript
{
    /**
     * @var
     */
    protected $config;

    /**
     * @var EnvFileWriter
     */
    protected $env;

    /**
     * @param Config        $config
     * @param EnvFileWriter $env
     */
    public function __construct(Config $config, EnvFileWriter $env)
    {
        $this->config = $config;
        $this->env = $env;
    }

    /**
     * @var Command
     */
    protected $command;

    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command)
    {
        $this->command = $command;
        $connected = false;

        while (! $connected) {
            $host = $this->askDatabaseHost();

            $name = $this->askDatabaseName();

            $port = $this->askDatabasePort();

            $user = $this->askDatabaseUsername();

            $password = $this->askDatabasePassword();

            $this->setLaravelConfiguration($name, $port, $user, $password, $host);

            if ($this->databaseConnectionIsValid()) {
                $connected = true;
            } else {
                $command->error("Please ensure your database credentials are valid.");
            }
        }

        $this->env->write($name, $port, $user, $password, $host);

        $command->info('Database successfully configured');
    }

    /**
     * @return string
     */
    protected function askDatabaseHost()
    {
        $host = $this->command->ask('Enter your database host', 'localhost');

        return $host;
    }

    /**
     * @return string
     */
    protected function askDatabaseName()
    {
        do {
            $name = $this->command->ask('Enter your database name', 'homestead');
            if ($name == '') {
                $this->command->error('Database name is required');
            }
        } while (!$name);

        return $name;
    }

    /**
     * @return string
     */
    protected function askDatabasePort()
    {
        do {
            $name = $this->command->ask('Enter your database port', '3306');
            if ($name == '') {
                $this->command->error('Database port is required');
            }
        } while (!$name);

        return $name;
    }

    /**
     * @param
     * @return string
     */
    protected function askDatabaseUsername()
    {
        do {
            $user = $this->command->ask('Enter your database username', 'homestead');
            if ($user == '') {
                $this->command->error('Database username is required');
            }
        } while (!$user);

        return $user;
    }

    /**
     * @param
     * @return string
     */
    protected function askDatabasePassword()
    {
        $databasePassword = $this->command->ask('Enter your database password (leave <none> for no password)', 'secret');

        return ($databasePassword === '<none>') ? '' : $databasePassword;
    }

    /**
     * @param $name
     * @param $user
     * @param $password
     */
    protected function setLaravelConfiguration($name, $port, $user, $password, $host)
    {
        $this->config['database.connections.facile.host'] = $host;
        $this->config['database.connections.facile.port'] = $port;
        $this->config['database.connections.facile.database'] = $name;
        $this->config['database.connections.facile.username'] = $user;
        $this->config['database.connections.facile.password'] = $password;
    }

    /**
     * Is the database connection valid?
     * @return bool
     */
    protected function databaseConnectionIsValid()
    {
        try {
            app('db')->reconnect('facile');
            DB::connection('facile')->getPdo();
            return true;
        } catch (PDOException $e) {
            $this->command->error($e->getMessage());
            return false;
        }
    }
}
