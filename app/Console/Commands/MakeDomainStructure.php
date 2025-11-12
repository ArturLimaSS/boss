<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeDomainStructure extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:domain {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria a estrutura de pastas para uma nova entidade de domínio';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name     = ucfirst($this->argument("name"));
        $basePath = app_path("Domain/{$name}");

        $folders = [
            "Entity",
            "Aggregated",
            "Repository",
            "UseCase",
            "ValueOjects",
            "DTO",
            "Routes",
        ];

        foreach ($folders as $folder) {
            $path = "{$basePath}/{$folder}";

            if (! File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            } else {
                $this->warn("Já existe: {$path}");
            }
            switch ($folder) {
                case "Entity":
                    $entityPath = "{$path}/{$name}.php";

                    if (! File::exists($entityPath)) {
                        File::put($entityPath, $this->getEntityStub($name));
                        $this->info("Criado: {$entityPath}");
                    }

                    break;
                case "Repository":
                    $interfacePath  = "{$path}/{$name}RepositoryInterface.php";
                    $repositoryPath = "{$path}/{$name}Repository.php";

                    if (! File::exists($interfacePath)) {
                        File::put($interfacePath, $this->getRepositoryInterfaceStub($name));
                        $this->info("Criado: {$interfacePath}");
                    }

                    if (! File::exists($repositoryPath)) {
                        File::put($repositoryPath, $this->getRepositoryStub($name));
                        $this->info("Criado: {$repositoryPath}");
                    }

                    break;

                case "DTO":

                    $entityPath = "{$path}/Listar{$name}DTO.php";

                    if (! File::exists($entityPath)) {
                        File::put($entityPath, $this->getDtoStub($name));
                        $this->info("Criado: {$entityPath}");
                    }

                    break;
                case "Routes":

                    $routeFilePath = "{$path}/{$name}Routes.php";
                    $routeInclude  = "require base_path('app/Domain/{$name}/Routes/{$name}Routes.php');";

                    $apiRoutesPath    = base_path('routes/api.php');
                    $apiRoutesContent = File::get($apiRoutesPath);

                    if (! str_contains($apiRoutesContent, $routeInclude)) {
                        File::append($apiRoutesPath, PHP_EOL . $routeInclude . PHP_EOL);
                        $this->info("Adicionado require em routes/api.php");
                    } else {
                        $this->warn("O require para {$name} já existe em routes/api.php");
                    }

                    if (! File::exists($routeFilePath)) {
                        $routeFileStub = $this->getRouteStub($name);
                        File::put($routeFilePath, $routeFileStub);
                        $this->info("Criado: {$routeFilePath}");
                    }

                    break;
                case "UseCase":
                    $metodos = [
                        "Listar",
                        "Cadastrar",
                        "Atualizar",
                        "Excluir",
                    ];

                    foreach ($metodos as $metodo) {
                        $useCasePath   = "{$path}/{$metodo}{$name}UseCase.php";
                        $interfacePath = "{$path}/{$metodo}{$name}UseCaseInterface.php";
                        switch ($metodo) {
                            case "Listar":
                                if (! File::exists($interfacePath)) {
                                    File::put($interfacePath, $this->getListarUseCaseInterfaceStub($name));
                                    $this->info("Criado: {$interfacePath}");
                                }

                                if (! File::exists($useCasePath)) {
                                    File::put($useCasePath, $this->getListarUseCaseStub($name));
                                    $this->info("Criado: {$useCasePath}");
                                }

                                break;
                            case "Cadastrar":

                                if (! File::exists($interfacePath)) {
                                    File::put($interfacePath, $this->getCadastrarUseCaseInterfaceStub($name));
                                    $this->info("Criado: {$interfacePath}");
                                }

                                if (! File::exists($useCasePath)) {
                                    File::put($useCasePath, $this->getCadastrarUseCaseStub($name));
                                    $this->info("Criado: {$useCasePath}");
                                }

                                break;
                            case "Atualizar":

                                if (! File::exists($interfacePath)) {
                                    File::put($interfacePath, $this->getAtualizarUseCaseInterfaceStub($name));
                                    $this->info("Criado: {$interfacePath}");
                                }

                                if (! File::exists($useCasePath)) {
                                    File::put($useCasePath, $this->getAtualizarUseCaseStub($name));
                                    $this->info("Criado: {$useCasePath}");
                                }

                                break;
                            case "Excluir":

                                if (! File::exists($interfacePath)) {
                                    File::put($interfacePath, $this->getExcluirUseCaseInterfaceStub($name));
                                    $this->info("Criado: {$interfacePath}");
                                }

                                if (! File::exists($useCasePath)) {
                                    File::put($useCasePath, $this->getExcluirUseCaseStub($name));
                                    $this->info("Criado: {$useCasePath}");
                                }

                                break;
                        };
                    }

                    break;
            }
        }

        $this->info("Estrutura de domínio '{$name}' criada com sucesso!");

        return 0;
    }

    private function getRouteStub($name)
    {
        $prefix        = strtolower($name);
        $routeFileStub = "<?php\n\nnamespace App\Domain\\{$name}\Routes;\n\n\n\nuse Illuminate\\Support\\Facades\\Route;\n\nRoute::middleware('auth:sanctum')->group(function () {\nRoute::group(['prefix' => '{$prefix}'], function () {\n// Add your {$name} routes here\n});\n});\n";

        return $routeFileStub;
    }

    private function getEntityStub($name)
    {
        return <<<PHP
<?php

namespace App\Domain\\{$name}\Entity;

use App\Domain\Entity;

class {$name} extends Entity
{
    // Propriedades e métodos da entidade {$name}
}
PHP;
    }

    private function getDtoStub($name)
    {
        return <<<PHP
<?php

namespace App\Domain\\{$name}\DTO;

use App\Abstract\DTO;

class Listar{$name}DTO extends DTO
{
    // Propriedades e métodos da entidade {$name}
}
PHP;
    }

    private function getRepositoryInterfaceStub($name)
    {
        return <<<PHP
<?php

namespace App\Domain\\{$name}\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface {$name}RepositoryInterface
{
    // Métodos esperados para o repositório de {$name}

    public function listar(\$dados): array|Collection|LengthAwarePaginator;

    public function cadastrar();

    public function atualizar();

    public function excluir(): void;

    public function findById();
}
PHP;
    }

    private function getRepositoryStub($name)
    {
        return <<<PHP
<?php

namespace App\Domain\\{$name}\Repository;

use App\Domain\\{$name}\Repository\\{$name}RepositoryInterface;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class {$name}Repository implements {$name}RepositoryInterface
{
    // Implementação do repositório de {$name}
    public function __construct(){}

    public function listar(\$dados): array|Collection|LengthAwarePaginator
    {
    }

    public function cadastrar()
    {
    }

    public function atualizar()
    {
    }

    public function excluir(): void 
    {
    }

    public function findById()
    {
    }
}
PHP;
    }

    public function getListarUseCaseInterfaceStub($name)
    {
        return <<<PHP
<?php

namespace App\Domain\\{$name}\UseCase;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface Listar{$name}UseCaseInterface
{
    public function execute(array \$dados): array|LengthAwarePaginator|Collection;
}
PHP;
    }

    public function getListarUseCaseStub($name)
    {
        return <<<PHP
<?php

namespace App\Domain\\{$name}\UseCase;

use App\Domain\\{$name}\UseCase\\Listar{$name}UseCaseInterface;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Listar{$name}UseCase implements Listar{$name}UseCaseInterface
{
    public function __construct(){}
    public function execute(array \$dados):array|LengthAwarePaginator|Collection
    {
        // Implementar Método de listagem de Listar{$name}UseCase
        return [];
    }
}
PHP;
    }

    // Cadastrar

    public function getCadastrarUseCaseInterfaceStub($name)
    {
        return <<<PHP
<?php

namespace App\Domain\\{$name}\UseCase;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface Cadastrar{$name}UseCaseInterface
{
    public function execute(array \$dados);
}
PHP;
    }

    public function getCadastrarUseCaseStub($name)
    {
        return <<<PHP
<?php

namespace App\Domain\\{$name}\UseCase;

use App\Domain\\{$name}\UseCase\\Cadastrar{$name}UseCaseInterface;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Cadastrar{$name}UseCase implements Cadastrar{$name}UseCaseInterface
{
    public function __construct(){}
    public function execute(array \$dados){}
}
PHP;
    }

    // Atualizar
    public function getAtualizarUseCaseInterfaceStub($name)
    {
        return <<<PHP
<?php

namespace App\Domain\\{$name}\UseCase;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface Atualizar{$name}UseCaseInterface
{
    public function execute(array \$dados);
}
PHP;
    }

    public function getAtualizarUseCaseStub($name)
    {
        return <<<PHP
<?php

namespace App\Domain\\{$name}\UseCase;

use App\Domain\\{$name}\UseCase\\Atualizar{$name}UseCaseInterface;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Atualizar{$name}UseCase implements Atualizar{$name}UseCaseInterface
{
    public function __construct(){}
    public function execute(array \$dados){}
}
PHP;
    }

    // Excluir

    public function getExcluirUseCaseInterfaceStub($name)
    {
        return <<<PHP
<?php

namespace App\Domain\\{$name}\UseCase;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface Excluir{$name}UseCaseInterface
{
    public function execute(array \$dados);
}
PHP;
    }

    public function getExcluirUseCaseStub($name)
    {
        return <<<PHP
<?php

namespace App\Domain\\{$name}\UseCase;

use App\Domain\\{$name}\UseCase\\Excluir{$name}UseCaseInterface;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Excluir{$name}UseCase implements Excluir{$name}UseCaseInterface
{
    public function __construct(){}
    public function execute(array \$dados){}
}
PHP;
    }
}
