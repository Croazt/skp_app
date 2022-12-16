<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateOperator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'skp:create-operator {nama=Administrator} {nip=123456789098765432}  {username=admin@admin.com} {password=password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create operator';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get string argument.
     *
     * @param string $key
     * @param string $default
     *
     * @return string
     */
    protected function getStringArgument(string $key, string $default): string
    {
        return is_string($this->argument($key)) ? $this->argument($key) : $default;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->getStringArgument('username', 'admin@admin.com');
        $nama = $this->getStringArgument('nama', 'admin');

        $newOperator = User::create([
            'nama'     => $nama,
            'username'     => $email,
            'nip'     => $this->argument('nip'),
            'pekerjaan'     => 'pekerjaan',
            'pangkat'     => 0,
            'unit_kerja'     => 'unit_kerja',
            'password' => Hash::make($this->getStringArgument('password', 'password')),
        ]);

        if($newOperator instanceof User)
            $newOperator->roles()->attach("Operator");


        $this->line('<info>Admin '.$email.' has been created.</info>');
        return Command::SUCCESS;
    }
}
