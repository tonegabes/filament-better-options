# Exemplos Avançados de Uso

Esta documentação apresenta exemplos práticos e avançados de como usar o Filament Better Options com o novo sistema de ícones extensível.

## Índice

1. [Configuração de E-commerce](#configuração-de-e-commerce)
2. [Sistema de Permissões](#sistema-de-permissões)
3. [Configurações de Aplicativo](#configurações-de-aplicativo)
4. [Dashboard Analytics](#dashboard-analytics)
5. [Formulário de Onboarding](#formulário-de-onboarding)
6. [Provedores Personalizados](#provedores-personalizados)
7. [Performance e Otimização](#performance-e-otimização)

## Configuração de E-commerce

### Seleção de Produtos com Categorias

```php
<?php

use ToneGabes\BetterOptions\Forms\Components\CheckboxCards;
use ToneGabes\BetterOptions\Forms\Components\RadioCards;

// Categorias de produtos com ícones Phosphor
CheckboxCards::make('product_categories')
    ->label('Categorias de Interesse')
    ->options([
        'electronics' => 'Eletrônicos',
        'clothing' => 'Moda & Roupas',
        'home_garden' => 'Casa & Jardim',
        'sports' => 'Esportes & Lazer',
        'books' => 'Livros & Educação',
        'automotive' => 'Automotivo',
    ])
    ->icons([
        'electronics' => 'device-mobile',
        'clothing' => 'tshirt',
        'home_garden' => 'house',
        'sports' => 'soccer-ball',
        'books' => 'book-open',
        'automotive' => 'car',
    ])
    ->descriptions([
        'electronics' => 'Smartphones, laptops, gadgets',
        'clothing' => 'Roupas masculinas e femininas',
        'home_garden' => 'Decoração e jardinagem',
        'sports' => 'Equipamentos esportivos',
        'books' => 'Livros físicos e digitais',
        'automotive' => 'Peças e acessórios',
    ])
    ->extraTexts([
        'electronics' => 'Mais vendido',
        'clothing' => 'Tendência',
        'sports' => 'Promoção',
    ])
    ->useIconProvider('phosphor')
    ->theme('modern')
    ->columns(3)
    ->searchable()
    ->bulkToggleable()
    ->required();

// Método de entrega
RadioCards::make('delivery_method')
    ->label('Método de Entrega')
    ->options([
        'standard' => 'Entrega Padrão',
        'express' => 'Entrega Expressa',
        'pickup' => 'Retirada na Loja',
        'same_day' => 'Entrega no Mesmo Dia',
    ])
    ->icons([
        'standard' => 'heroicon-o-truck',
        'express' => 'heroicon-o-bolt',
        'pickup' => 'heroicon-o-building-storefront',
        'same_day' => 'heroicon-o-clock',
    ])
    ->descriptions([
        'standard' => '5-7 dias úteis',
        'express' => '2-3 dias úteis',
        'pickup' => 'Disponível hoje',
        'same_day' => 'Até às 18h',
    ])
    ->extraTexts([
        'standard' => 'Grátis',
        'express' => 'R$ 15,90',
        'pickup' => 'Grátis',
        'same_day' => 'R$ 29,90',
    ])
    ->useIconProvider('heroicons')
    ->columns(2)
    ->required();
```

### Configuração de Pagamento

```php
RadioCards::make('payment_method')
    ->label('Forma de Pagamento')
    ->options([
        'credit_card' => 'Cartão de Crédito',
        'debit_card' => 'Cartão de Débito',
        'pix' => 'PIX',
        'boleto' => 'Boleto Bancário',
        'wallet' => 'Carteira Digital',
    ])
    ->icons([
        'credit_card' => 'credit-card',
        'debit_card' => 'identification-card',
        'pix' => 'qr-code',
        'boleto' => 'barcode',
        'wallet' => 'wallet',
    ])
    ->descriptions([
        'credit_card' => 'Parcelamento em até 12x',
        'debit_card' => 'À vista com desconto',
        'pix' => 'Aprovação instantânea',
        'boleto' => 'Vencimento em 3 dias',
        'wallet' => 'PayPal, Apple Pay, Google Pay',
    ])
    ->extraTexts([
        'debit_card' => '5% desconto',
        'pix' => '10% desconto',
        'wallet' => 'Cashback 2%',
    ])
    ->useIconProvider('phosphor')
    ->theme('classic')
    ->columns(1)
    ->required();
```

## Sistema de Permissões

### Gerenciamento de Roles

```php
CheckboxCards::make('user_permissions')
    ->label('Permissões do Usuário')
    ->options([
        'users_read' => 'Visualizar Usuários',
        'users_create' => 'Criar Usuários',
        'users_edit' => 'Editar Usuários',
        'users_delete' => 'Excluir Usuários',
        'content_read' => 'Visualizar Conteúdo',
        'content_create' => 'Criar Conteúdo',
        'content_edit' => 'Editar Conteúdo',
        'content_delete' => 'Excluir Conteúdo',
        'reports_view' => 'Visualizar Relatórios',
        'reports_export' => 'Exportar Relatórios',
        'settings_view' => 'Visualizar Configurações',
        'settings_edit' => 'Editar Configurações',
    ])
    ->icons([
        'users_read' => 'eye',
        'users_create' => 'user-plus',
        'users_edit' => 'user-gear',
        'users_delete' => 'user-minus',
        'content_read' => 'article',
        'content_create' => 'plus-circle',
        'content_edit' => 'pencil',
        'content_delete' => 'trash',
        'reports_view' => 'chart-bar',
        'reports_export' => 'download',
        'settings_view' => 'gear',
        'settings_edit' => 'gear-fine',
    ])
    ->descriptions([
        'users_read' => 'Listar e visualizar perfis de usuários',
        'users_create' => 'Adicionar novos usuários ao sistema',
        'users_edit' => 'Modificar dados de usuários existentes',
        'users_delete' => 'Remover usuários do sistema',
        'content_read' => 'Acessar e visualizar todo conteúdo',
        'content_create' => 'Criar novos posts e páginas',
        'content_edit' => 'Modificar conteúdo existente',
        'content_delete' => 'Remover posts e páginas',
        'reports_view' => 'Acessar dashboard e relatórios',
        'reports_export' => 'Baixar relatórios em PDF/Excel',
        'settings_view' => 'Visualizar configurações do sistema',
        'settings_edit' => 'Modificar configurações gerais',
    ])
    ->extraTexts([
        'users_delete' => 'Cuidado',
        'content_delete' => 'Cuidado',
        'settings_edit' => 'Admin',
    ])
    ->useIconProvider('phosphor')
    ->theme('minimal')
    ->columns(3)
    ->searchable()
    ->searchPrompt('Buscar permissões...')
    ->bulkToggleable()
    ->selectAllAction(
        \Filament\Forms\Components\Actions\Action::make('selectAll')
            ->label('Selecionar Todas')
            ->icon('phosphor-check-circle')
    )
    ->deselectAllAction(
        \Filament\Forms\Components\Actions\Action::make('deselectAll')
            ->label('Limpar Seleção')
            ->icon('phosphor-x-circle')
    );
```

### Níveis de Acesso

```php
RadioCards::make('access_level')
    ->label('Nível de Acesso')
    ->options([
        'viewer' => 'Visualizador',
        'editor' => 'Editor',
        'moderator' => 'Moderador',
        'admin' => 'Administrador',
        'super_admin' => 'Super Administrador',
    ])
    ->icons([
        'viewer' => 'eye',
        'editor' => 'pencil-simple',
        'moderator' => 'shield-check',
        'admin' => 'crown-simple',
        'super_admin' => 'crown',
    ])
    ->descriptions([
        'viewer' => 'Apenas visualização, sem edição',
        'editor' => 'Pode criar e editar conteúdo próprio',
        'moderator' => 'Pode moderar conteúdo de outros usuários',
        'admin' => 'Controle total do sistema',
        'super_admin' => 'Acesso irrestrito a tudo',
    ])
    ->extraTexts([
        'admin' => 'Recomendado',
        'super_admin' => 'Máximo',
    ])
    ->useIconProvider('phosphor')
    ->theme('modern')
    ->columns(1)
    ->required();
```

## Configurações de Aplicativo

### Preferências de Usuário

```php
CheckboxCards::make('notification_preferences')
    ->label('Preferências de Notificação')
    ->options([
        'email_marketing' => 'E-mails Promocionais',
        'email_updates' => 'Atualizações por E-mail',
        'sms_alerts' => 'Alertas por SMS',
        'push_notifications' => 'Notificações Push',
        'newsletter' => 'Newsletter Semanal',
        'security_alerts' => 'Alertas de Segurança',
    ])
    ->icons([
        'email_marketing' => 'envelope-simple',
        'email_updates' => 'bell',
        'sms_alerts' => 'device-mobile',
        'push_notifications' => 'bell-ringing',
        'newsletter' => 'newspaper',
        'security_alerts' => 'shield-warning',
    ])
    ->descriptions([
        'email_marketing' => 'Ofertas especiais e promoções',
        'email_updates' => 'Atualizações importantes do sistema',
        'sms_alerts' => 'Alertas urgentes via SMS',
        'push_notifications' => 'Notificações no navegador/app',
        'newsletter' => 'Resumo semanal de novidades',
        'security_alerts' => 'Alertas de login e segurança',
    ])
    ->extraTexts([
        'security_alerts' => 'Recomendado',
        'email_updates' => 'Importante',
    ])
    ->useIconProvider('phosphor')
    ->theme('modern')
    ->columns(2)
    ->bulkToggleable();

// Tema da aplicação
RadioCards::make('app_theme')
    ->label('Tema da Aplicação')
    ->options([
        'light' => 'Claro',
        'dark' => 'Escuro',
        'auto' => 'Automático',
        'high_contrast' => 'Alto Contraste',
    ])
    ->icons([
        'light' => 'sun',
        'dark' => 'moon',
        'auto' => 'circle-half',
        'high_contrast' => 'eye',
    ])
    ->descriptions([
        'light' => 'Interface clara e brilhante',
        'dark' => 'Interface escura, ideal para ambientes com pouca luz',
        'auto' => 'Segue a configuração do sistema',
        'high_contrast' => 'Máximo contraste para acessibilidade',
    ])
    ->useIconProvider('phosphor')
    ->columns(2)
    ->default('auto');
```

## Dashboard Analytics

### Métricas de Performance

```php
CheckboxCards::make('dashboard_widgets')
    ->label('Widgets do Dashboard')
    ->options([
        'revenue_chart' => 'Gráfico de Receita',
        'user_growth' => 'Crescimento de Usuários',
        'conversion_rate' => 'Taxa de Conversão',
        'traffic_sources' => 'Fontes de Tráfego',
        'top_products' => 'Produtos Mais Vendidos',
        'geographic_data' => 'Dados Geográficos',
        'real_time_visitors' => 'Visitantes em Tempo Real',
        'bounce_rate' => 'Taxa de Rejeição',
    ])
    ->icons([
        'revenue_chart' => 'chart-line-up',
        'user_growth' => 'trend-up',
        'conversion_rate' => 'target',
        'traffic_sources' => 'globe',
        'top_products' => 'ranking',
        'geographic_data' => 'map-pin',
        'real_time_visitors' => 'pulse',
        'bounce_rate' => 'arrow-u-down-left',
    ])
    ->descriptions([
        'revenue_chart' => 'Visualização da receita ao longo do tempo',
        'user_growth' => 'Acompanhamento do crescimento da base de usuários',
        'conversion_rate' => 'Percentual de conversões por período',
        'traffic_sources' => 'Origem do tráfego do site',
        'top_products' => 'Produtos com melhor performance',
        'geographic_data' => 'Distribuição geográfica dos usuários',
        'real_time_visitors' => 'Usuários ativos no momento',
        'bounce_rate' => 'Percentual de saídas rápidas',
    ])
    ->useIconProvider('phosphor')
    ->theme('modern')
    ->columns(4)
    ->searchable()
    ->bulkToggleable();
```

## Formulário de Onboarding

### Configuração Inicial

```php
// Passo 1: Tipo de negócio
RadioCards::make('business_type')
    ->label('Tipo do seu Negócio')
    ->options([
        'ecommerce' => 'E-commerce',
        'saas' => 'Software (SaaS)',
        'blog' => 'Blog/Conteúdo',
        'portfolio' => 'Portfólio',
        'corporate' => 'Corporativo',
        'nonprofit' => 'ONG/Sem fins lucrativos',
    ])
    ->icons([
        'ecommerce' => 'shopping-cart',
        'saas' => 'cloud',
        'blog' => 'article',
        'portfolio' => 'briefcase',
        'corporate' => 'buildings',
        'nonprofit' => 'heart',
    ])
    ->descriptions([
        'ecommerce' => 'Venda de produtos online',
        'saas' => 'Aplicativo web ou serviço',
        'blog' => 'Site de conteúdo e artigos',
        'portfolio' => 'Showcase de trabalhos',
        'corporate' => 'Site institucional',
        'nonprofit' => 'Organização sem fins lucrativos',
    ])
    ->useIconProvider('phosphor')
    ->theme('modern')
    ->columns(3)
    ->required();

// Passo 2: Funcionalidades desejadas
CheckboxCards::make('desired_features')
    ->label('Que funcionalidades você precisa?')
    ->options([
        'analytics' => 'Analytics Avançado',
        'seo_tools' => 'Ferramentas SEO',
        'social_integration' => 'Integração Social',
        'email_marketing' => 'E-mail Marketing',
        'payment_gateway' => 'Gateway de Pagamento',
        'multi_language' => 'Multi-idioma',
        'mobile_app' => 'App Mobile',
        'api_integration' => 'Integração API',
    ])
    ->icons([
        'analytics' => 'chart-pie',
        'seo_tools' => 'magnifying-glass',
        'social_integration' => 'share-network',
        'email_marketing' => 'envelope',
        'payment_gateway' => 'credit-card',
        'multi_language' => 'globe-hemisphere-west',
        'mobile_app' => 'device-mobile',
        'api_integration' => 'plugs-connected',
    ])
    ->descriptions([
        'analytics' => 'Relatórios detalhados e insights',
        'seo_tools' => 'Otimização para motores de busca',
        'social_integration' => 'Conexão com redes sociais',
        'email_marketing' => 'Campanhas automatizadas',
        'payment_gateway' => 'Processamento de pagamentos',
        'multi_language' => 'Suporte a múltiplos idiomas',
        'mobile_app' => 'Aplicativo nativo',
        'api_integration' => 'Conexão com serviços externos',
    ])
    ->extraTexts([
        'analytics' => 'Popular',
        'seo_tools' => 'Essencial',
        'payment_gateway' => 'Premium',
    ])
    ->useIconProvider('phosphor')
    ->columns(4)
    ->searchable()
    ->bulkToggleable();
```

## Provedores Personalizados

### Exemplo: Lucide Icons

```php
<?php

namespace App\IconProviders;

use ToneGabes\BetterOptions\Contracts\IconProvider;

class LucideIconProvider implements IconProvider
{
    public function getName(): string
    {
        return 'lucide';
    }

    public function getDefaultIcons(): array
    {
        return [
            'checkbox_idle' => 'lucide-square',
            'checkbox_selected' => 'lucide-check-square',
            'radio_idle' => 'lucide-circle',
            'radio_selected' => 'lucide-check-circle',
            'search' => 'lucide-search',
            'clear_search' => 'lucide-x',
            'select_all' => 'lucide-check-circle-2',
            'deselect_all' => 'lucide-x-circle',
            'loading' => 'lucide-loader-2',
            'error' => 'lucide-alert-triangle',
            'success' => 'lucide-check-circle',
        ];
    }

    public function supports(string $iconName): bool
    {
        return str_starts_with($iconName, 'lucide-') ||
               in_array($iconName, $this->getCommonIcons());
    }

    public function resolveIcon(string $iconName): string
    {
        if (str_starts_with($iconName, 'lucide-')) {
            return $iconName;
        }

        if (in_array($iconName, $this->getCommonIcons())) {
            return 'lucide-' . $iconName;
        }

        return 'lucide-' . str_replace('_', '-', strtolower($iconName));
    }

    public function getAvailableIcons(): array
    {
        return [
            'heart' => 'lucide-heart',
            'star' => 'lucide-star',
            'user' => 'lucide-user',
            'home' => 'lucide-home',
            'settings' => 'lucide-settings',
            'mail' => 'lucide-mail',
            'phone' => 'lucide-phone',
            'calendar' => 'lucide-calendar',
            'clock' => 'lucide-clock',
            'map-pin' => 'lucide-map-pin',
            'camera' => 'lucide-camera',
            'image' => 'lucide-image',
            'file' => 'lucide-file',
            'folder' => 'lucide-folder',
            'download' => 'lucide-download',
            'upload' => 'lucide-upload',
            'edit' => 'lucide-edit',
            'trash' => 'lucide-trash',
            'plus' => 'lucide-plus',
            'minus' => 'lucide-minus',
        ];
    }

    private function getCommonIcons(): array
    {
        return array_keys($this->getAvailableIcons());
    }
}
```

### Usando o Provedor Lucide

```php
// Registrar no config/better-options.php
'providers' => [
    'phosphor' => \ToneGabes\BetterOptions\IconProviders\PhosphorIconProvider::class,
    'heroicons' => \ToneGabes\BetterOptions\IconProviders\HeroIconProvider::class,
    'lucide' => \App\IconProviders\LucideIconProvider::class,
],

// Usar nos componentes
CheckboxCards::make('tools')
    ->options([
        'camera' => 'Câmera',
        'edit' => 'Editor',
        'calendar' => 'Calendário',
    ])
    ->icons([
        'camera' => 'camera',
        'edit' => 'edit',
        'calendar' => 'calendar',
    ])
    ->useIconProvider('lucide');
```

## Performance e Otimização

### Configuração de Cache

```php
// config/better-options.php
return [
    'performance' => [
        'cache_icons' => true,
        'cache_ttl' => 120, // 2 horas
        'lazy_load_js' => true,
    ],

    'development' => [
        'debug' => app()->environment('local'),
        'validate_icons' => app()->environment('local'),
    ],
];
```

### Monitoramento de Performance

```php
use ToneGabes\BetterOptions\Facades\BetterOptionsIcon;

// Em um Command ou Job
class OptimizeIconsCommand extends Command
{
    public function handle()
    {
        $stats = BetterOptionsIcon::getStats();

        $this->info("Icon System Statistics:");
        $this->info("Total Providers: " . $stats['total_providers']);
        $this->info("Default Provider: " . $stats['default_provider']);

        foreach ($stats['providers'] as $name => $info) {
            $this->info("- {$name}: {$info['available_icons_count']} icons");
        }

        // Pré-carrega ícones mais usados
        $commonIcons = ['heart', 'star', 'user', 'home', 'settings'];
        foreach ($commonIcons as $icon) {
            BetterOptionsIcon::resolveIcon($icon);
        }

        $this->info("Common icons pre-cached successfully!");
    }
}
```

### Validação em Desenvolvimento

```php
// Em um Service Provider ou Middleware de desenvolvimento
if (app()->environment('local')) {
    $components = [
        CheckboxCards::make('test')->icons(['test' => 'invalid-icon']),
        RadioCards::make('test2')->icons(['test' => 'another-invalid']),
    ];

    foreach ($components as $component) {
        $errors = $component->validateIcons();
        if (!empty($errors)) {
            logger()->channel('icon-validation')->warning('Icon validation errors:', $errors);
        }
    }
}
```

## Integração com Outros Sistemas

### Sincronização com Design System

```php
// Service para sincronizar com design system da empresa
class DesignSystemIconProvider implements IconProvider
{
    private array $designSystemIcons;

    public function __construct()
    {
        // Carrega ícones do design system via API
        $this->designSystemIcons = $this->loadFromDesignSystem();
    }

    public function getName(): string
    {
        return 'design-system';
    }

    public function getDefaultIcons(): array
    {
        return $this->designSystemIcons['defaults'] ?? [];
    }

    public function supports(string $iconName): bool
    {
        return isset($this->designSystemIcons['icons'][$iconName]);
    }

    public function resolveIcon(string $iconName): string
    {
        return $this->designSystemIcons['icons'][$iconName] ?? $iconName;
    }

    public function getAvailableIcons(): array
    {
        return $this->designSystemIcons['icons'] ?? [];
    }

    private function loadFromDesignSystem(): array
    {
        // Implementação para carregar do design system
        return cache()->remember('design-system-icons', 3600, function () {
            // API call ou arquivo de configuração
            return [];
        });
    }
}
```

Estes exemplos demonstram a flexibilidade e poder do sistema de ícones extensível do Filament Better Options, permitindo criar interfaces ricas e personalizadas para qualquer tipo de aplicação.
