<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aluno;
use Illuminate\Support\Facades\Hash;

class AlunosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cria 50 alunos fictícios
        for ($i = 0; $i < 50; $i++) {
            $nome = 'Aluno ' . ($i + 1);
            $sobrenome = 'Sobrenome ' . ($i + 1);
            $email = 'aluno' . ($i + 1) . '@gmail.com';
            $senha = 'password'; // Defina a senha para todos os alunos, se necessário

            // Cria um registro de aluno no banco de dados
            Aluno::create([
                'nome' => $nome,
                'sobrenome' => $sobrenome,
                'email' => $email,
                'senha' => Hash::make($senha), // Use Hash::make para criptografar a senha
            ]);
        }
    }
}
