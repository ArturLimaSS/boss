<?php

namespace App\Providers;

use App\Domain\Auth\UseCase\AuthenticationUseCase;
use App\Domain\Auth\UseCase\AuthenticationUseCaseInterface;
use App\Domain\Auth\UseCase\SSOCheckUseCase;
use App\Domain\Auth\UseCase\SSOCheckUseCaseInterface;
use App\Domain\Inquilino\UseCase\CadastrarInquilinoUseCase;
use App\Domain\Inquilino\UseCase\CadastrarInquilinoUseCaseInterface;
use App\Domain\Inquilino\UseCase\ListarInquilinoPorModuloUseCase;
use App\Domain\Inquilino\UseCase\ListarInquilinoPorModuloUseCaseInterface;
use App\Domain\Inquilino\UseCase\ListarInquilinoUseCase;
use App\Domain\Inquilino\UseCase\ListarInquilinoUseCaseInterface;
use App\Domain\Inquilino\UseCase\ListarModulosUseCase;
use App\Domain\Inquilino\UseCase\ListarModulosUseCaseInterface;
use App\Domain\Usuario\UseCase\AcessarModuloUseCase;
use App\Domain\Usuario\UseCase\AcessarModuloUseCaseInterface;
use App\Domain\Usuario\UseCase\AtualizarModulosUsuarioUseCase;
use App\Domain\Usuario\UseCase\AtualizarModulosUsuarioUseCaseInterface;
use App\Domain\Usuario\UseCase\AtualizarUsuarioUseCase;
use App\Domain\Usuario\UseCase\AtualizarUsuarioUseCaseInterface;
use App\Domain\Usuario\UseCase\CadastrarUsuarioUseCase;
use App\Domain\Usuario\UseCase\CadastrarUsuarioUseCaseInterface;
use App\Domain\Usuario\UseCase\ExcluirUsuarioUseCase;
use App\Domain\Usuario\UseCase\ExcluirUsuarioUseCaseInterface;
use App\Domain\Usuario\UseCase\ListarModulosUsuarioUseCase;
use App\Domain\Usuario\UseCase\ListarModulosUsuarioUseCaseInterface;
use App\Domain\Usuario\UseCase\ListarUsuarioTipoUseCase;
use App\Domain\Usuario\UseCase\ListarUsuarioTipoUseCaseInterface;
use App\Domain\Usuario\UseCase\ListarUsuarioUseCase;
use App\Domain\Usuario\UseCase\ListarUsuarioUseCaseInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $bidings = [
            CadastrarInquilinoUseCaseInterface::class       => CadastrarInquilinoUseCase::class,
            ListarInquilinoUseCaseInterface::class          => ListarInquilinoUseCase::class,
            AuthenticationUseCaseInterface::class           => AuthenticationUseCase::class,
            ListarInquilinoPorModuloUseCaseInterface::class => ListarInquilinoPorModuloUseCase::class,
            ListarModulosUseCaseInterface::class            => ListarModulosUseCase::class,
            AtualizarModulosUsuarioUseCaseInterface::class  => AtualizarModulosUsuarioUseCase::class,
            AcessarModuloUseCaseInterface::class            => AcessarModuloUseCase::class,
            SSOCheckUseCaseInterface::class                 => SSOCheckUseCase::class,

            // Usuario
            CadastrarUsuarioUseCaseInterface::class     => CadastrarUsuarioUseCase::class,
            ListarUsuarioUseCaseInterface::class        => ListarUsuarioUseCase::class,
            AtualizarUsuarioUseCaseInterface::class     => AtualizarUsuarioUseCase::class,
            ExcluirUsuarioUseCaseInterface::class       => ExcluirUsuarioUseCase::class,
            ListarUsuarioTipoUseCaseInterface::class    => ListarUsuarioTipoUseCase::class,
            ListarModulosUsuarioUseCaseInterface::class => ListarModulosUsuarioUseCase::class,
        ];

        foreach ($bidings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
