# Sistema de Ícones Extensível

O Filament Better Options inclui um sistema avançado e extensível para gerenciamento de ícones que permite:

- Múltiplos provedores de ícones (Phosphor, Heroicons, Font Awesome, etc.)
- Configuração dinâmica e resolução automática
- Temas pré-definidos para diferentes estilos visuais
- Cache de performance e validação de ícones
- Extensibilidade completa para provedores personalizados

## Visão Geral

### Arquitetura do Sistema

```
┌─────────────────────────────────────────────────────────┐
│                    IconManager                          │
│  (Coordena todos os provedores de ícones)              │
└─────────────────────────────────────────────────────────┘
                            │
        ┌───────────────────┼───────────────────┐
        │                   │                   │
┌───────────────┐  ┌─────────────────┐  ┌─────────────────┐
│ PhosphorIcon  │  │  HeroIconProvider │  │ CustomProvider  │
│   Provider    │  │                   │  │   (Seu)        │
└───────────────┘  └─────────────────┘  └─────────────────┘
```

### Componentes Principais

1. **IconProvider Interface**: Define o contrato para todos os provedores
2. **IconManager Service**: Gerencia e coordena múltiplos provedores
3. **Managed Traits**: Fornecem funcionalidade avançada aos componentes
4. **Configuration System**: Permite personalização via arquivos de configuração

## Configuração

### Configuração Básica

```php
// config/better-options.php
return [
    'icons' => [
        'default_provider' => 'phosphor', // ou 'heroicons'

        'providers' => [
            'phosphor' => \ToneGabes\BetterOptions\IconProviders\PhosphorIconProvider::class,
            'heroicons' => \ToneGabes\BetterOptions\IconProviders\HeroIconProvider::class,
            // Adicione seus provedores personalizados aqui
        ],

        'defaults' => [
            'checkbox_idle' => 'phosphor-square',
            'checkbox_selected' => 'phosphor-check-square-fill',
            'radio_idle' => 'phosphor-circle',
            'radio_selected' => 'phosphor-check-circle-fill',
        ],
    ],
];
```

### Variáveis de Ambiente

```bash
# .env
BETTER_OPTIONS_ICON_PROVIDER=phosphor
BETTER_OPTIONS_CACHE_ICONS=true
BETTER_OPTIONS_DEBUG=false
```

## Uso Básico

### Usando Ícones nos Componentes

```php
use ToneGabes\BetterOptions\Forms\Components\CheckboxCards;

CheckboxCards::make('features')
    ->options([
        'performance' => 'Alta Performance',
        'security' => 'Segurança Avançada',
        'scalability' => 'Escalabilidade',
    ])
    ->icons([
        'performance' => 'phosphor-lightning',
        'security' => 'heroicon-o-shield-check',
        'scalability' => 'phosphor-trending-up',
    ])
    ->useIconProvider('phosphor'); // Provedor preferido
```

### Temas Pré-definidos

```php
CheckboxCards::make('options')
    ->options($options)
    ->theme('modern'); // minimal, modern, classic

// Equivale a:
CheckboxCards::make('options')
    ->options($options)
    ->iconBefore()
    ->indicatorAfter()
    ->itemsCenter();
```

### Usando o Facade

```php
use ToneGabes\BetterOptions\Facades\BetterOptionsIcon;

// Resolver um ícone
$icon = BetterOptionsIcon::resolveIcon('lightning');

// Obter ícones padrão
$defaults = BetterOptionsIcon::getDefaultIcons();

// Verificar se um ícone é suportado
$isSupported = BetterOptionsIcon::isSupported('phosphor-heart');
```

## Criando Provedores Personalizados

### 1. Implementar a Interface

```php
<?php

namespace App\IconProviders;

use ToneGabes\BetterOptions\Contracts\IconProvider;

class FontAwesomeIconProvider implements IconProvider
{
    public function getName(): string
    {
        return 'fontawesome';
    }

    public function getDefaultIcons(): array
    {
        return [
            'checkbox_idle' => 'fas fa-square',
            'checkbox_selected' => 'fas fa-check-square',
            'radio_idle' => 'far fa-circle',
            'radio_selected' => 'fas fa-dot-circle',
            'search' => 'fas fa-search',
            'loading' => 'fas fa-spinner fa-spin',
        ];
    }

    public function supports(string $iconName): bool
    {
        return str_starts_with($iconName, 'fa-') ||
               str_starts_with($iconName, 'fas ') ||
               str_starts_with($iconName, 'far ') ||
               str_starts_with($iconName, 'fab ');
    }

    public function resolveIcon(string $iconName): string
    {
        if ($this->supports($iconName)) {
            return $iconName;
        }

        // Adiciona prefixo padrão se necessário
        return 'fas fa-' . str_replace('_', '-', $iconName);
    }

    public function getAvailableIcons(): array
    {
        return [
            'heart' => 'fas fa-heart',
            'star' => 'fas fa-star',
            'user' => 'fas fa-user',
            'home' => 'fas fa-home',
            // ... mais ícones
        ];
    }
}
```

### 2. Registrar o Provedor

```php
// config/better-options.php
'providers' => [
    'phosphor' => \ToneGabes\BetterOptions\IconProviders\PhosphorIconProvider::class,
    'heroicons' => \ToneGabes\BetterOptions\IconProviders\HeroIconProvider::class,
    'fontawesome' => \App\IconProviders\FontAwesomeIconProvider::class,
],
```

### 3. Usar o Provedor

```php
CheckboxCards::make('social')
    ->options([
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'instagram' => 'Instagram',
    ])
    ->icons([
        'facebook' => 'fab fa-facebook',
        'twitter' => 'fab fa-twitter',
        'instagram' => 'fab fa-instagram',
    ])
    ->useIconProvider('fontawesome');
```

## Funcionalidades Avançadas

### Cache de Performance

O sistema inclui cache automático para resolução de ícones:

```php
// config/better-options.php
'performance' => [
    'cache_icons' => true,
    'cache_ttl' => 60, // minutos
],
```

### Validação de Ícones

Em modo de desenvolvimento, o sistema pode validar se todos os ícones existem:

```php
// config/better-options.php
'development' => [
    'validate_icons' => true,
    'debug' => true,
],
```

### Debug e Estatísticas

```php
// Obter informações de debug de um componente
$component = CheckboxCards::make('test')
    ->icons(['option1' => 'phosphor-heart']);

$debugInfo = $component->getDebugInfo();
// Retorna estatísticas de ícones, indicadores e erros de validação

// Estatísticas globais do IconManager
$stats = BetterOptionsIcon::getStats();
```

### Registrar Provedores Programaticamente

```php
use ToneGabes\BetterOptions\Facades\BetterOptionsIcon;

// Em um Service Provider
BetterOptionsIcon::registerProvider(new CustomIconProvider());
BetterOptionsIcon::setDefaultProvider('custom');
```

## Temas e Estilos

### Temas Pré-definidos

#### Minimal
- Indicadores parcialmente ocultos
- Ícones após o texto
- Indicadores antes do texto

```php
->theme('minimal')
```

#### Modern
- Ícones antes do texto
- Indicadores após o texto
- Conteúdo centralizado

```php
->theme('modern')
```

#### Classic
- Ícones após o texto
- Indicadores antes do texto
- Layout tradicional

```php
->theme('classic')
```

### Personalização Manual

```php
CheckboxCards::make('options')
    ->iconBefore()           // ou ->iconAfter()
    ->indicatorAfter()       // ou ->indicatorBefore()
    ->itemsCenter()          // centralizar conteúdo
    ->partiallyHiddenIndicator() // indicadores sutis
    ->hiddenIcon()           // ocultar ícones
    ->hiddenIndicator();     // ocultar indicadores
```

## Migração e Compatibilidade

### Migrando do Sistema Antigo

O novo sistema mantém compatibilidade com o código existente:

```php
// Código antigo - ainda funciona
CheckboxCards::make('options')
    ->icons(['option1' => 'heroicon-o-heart'])
    ->idleIndicator('heroicon-o-circle')
    ->selectedIndicator('heroicon-o-check-circle');

// Novo sistema - mais flexível
CheckboxCards::make('options')
    ->icons(['option1' => 'heart']) // Resolução automática
    ->useIconProvider('phosphor')
    ->theme('modern');
```

### Detecção de Problemas

```php
// Validar configuração
$errors = $component->validateIcons();
if (!empty($errors)) {
    foreach ($errors as $error) {
        logger()->warning($error);
    }
}
```

## Performance

### Otimizações Implementadas

1. **Cache de Resolução**: Ícones resolvidos são armazenados em cache
2. **Lazy Loading**: Provedores são carregados apenas quando necessários
3. **Validação Condicional**: Validação ocorre apenas em desenvolvimento
4. **Singleton Pattern**: IconManager é um singleton para evitar recriação

### Monitoramento

```php
// Estatísticas de performance
$stats = BetterOptionsIcon::getStats();
echo "Total de provedores: " . $stats['total_providers'];
echo "Provedor padrão: " . $stats['default_provider'];

foreach ($stats['providers'] as $name => $info) {
    echo "{$name}: {$info['available_icons_count']} ícones disponíveis";
}
```

## Exemplos Práticos

### E-commerce com Diferentes Provedores

```php
// Categorias de produtos com Phosphor
CheckboxCards::make('categories')
    ->options([
        'electronics' => 'Eletrônicos',
        'clothing' => 'Roupas',
        'books' => 'Livros',
    ])
    ->icons([
        'electronics' => 'device-mobile',
        'clothing' => 'tshirt',
        'books' => 'book',
    ])
    ->useIconProvider('phosphor')
    ->theme('modern');

// Métodos de pagamento com Heroicons
RadioCards::make('payment_method')
    ->options([
        'credit' => 'Cartão de Crédito',
        'debit' => 'Cartão de Débito',
        'pix' => 'PIX',
    ])
    ->icons([
        'credit' => 'heroicon-o-credit-card',
        'debit' => 'heroicon-o-banknotes',
        'pix' => 'heroicon-o-qr-code',
    ])
    ->useIconProvider('heroicons');
```

### Sistema de Permissões

```php
CheckboxCards::make('permissions')
    ->options([
        'read' => 'Leitura',
        'write' => 'Escrita',
        'delete' => 'Exclusão',
        'admin' => 'Administrador',
    ])
    ->icons([
        'read' => 'eye',
        'write' => 'pencil',
        'delete' => 'trash',
        'admin' => 'crown',
    ])
    ->descriptions([
        'read' => 'Visualizar conteúdo',
        'write' => 'Criar e editar',
        'delete' => 'Remover itens',
        'admin' => 'Controle total',
    ])
    ->theme('minimal')
    ->searchable()
    ->bulkToggleable();
```

## Solução de Problemas

### Ícones Não Aparecem

1. Verifique se o provedor está registrado
2. Confirme se o ícone existe no provedor
3. Verifique logs de validação em modo debug

### Performance Lenta

1. Habilite o cache de ícones
2. Verifique se não há muitos provedores desnecessários
3. Use validação apenas em desenvolvimento

### Conflitos de Provedores

1. Defina um provedor preferido específico
2. Use nomes de ícones completos com prefixos
3. Implemente lógica de fallback personalizada

## Contribuindo

Para contribuir com novos provedores de ícones:

1. Implemente a interface `IconProvider`
2. Adicione testes unitários
3. Atualize a documentação
4. Submeta um Pull Request

### Estrutura de Testes

```php
class CustomIconProviderTest extends TestCase
{
    public function test_provider_supports_icons()
    {
        $provider = new CustomIconProvider();

        $this->assertTrue($provider->supports('custom-icon'));
        $this->assertFalse($provider->supports('invalid-icon'));
    }

    public function test_provider_resolves_icons()
    {
        $provider = new CustomIconProvider();

        $resolved = $provider->resolveIcon('heart');
        $this->assertEquals('custom-heart', $resolved);
    }
}
```

Este sistema fornece uma base sólida e extensível para gerenciamento de ícones, permitindo que desenvolvedores personalizem completamente a aparência visual dos componentes Better Options.
