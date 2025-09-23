<?php

namespace App\Providers\Filament;

use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\PanelProvider;

class FilamentPanelProvider extends PanelProvider
{
    public function panel(\Filament\Panel $panel): \Filament\Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->pages([
                \Filament\Pages\Dashboard::class,
            ])
            ->homeUrl(fn () => auth()->check() ? route('filament.admin.pages.dashboard') : route('filament.admin.auth.login'))
            ->navigation(function (NavigationBuilder $navigation): NavigationBuilder {
                return $navigation->groups([
                    NavigationGroup::make('Tableau de bord')->items([
                        NavigationItem::make('Actions rapides')
                            ->url('/admin/dashboard/actions-rapides'),
                        NavigationItem::make('Indicateurs clés')
                            ->url('/admin/dashboard/indicateurs'),
                    ]),
                    NavigationGroup::make('Collaborateurs')->items([
                        NavigationItem::make('Liste des Collaborateurs')
                            ->url('/admin/collaborateurs'),
                    ]),
                    NavigationGroup::make('Temps de travail & absences')->items([
                        NavigationItem::make('Congés & absences')
                            ->url('/admin/absences'),
                    ]),
                    NavigationGroup::make('Paie')->items([
                        NavigationItem::make('Clôturer la paie')
                            ->url('/admin/paie/cloturer'),
                        NavigationItem::make('Éléments de rémunération')
                            ->url('/admin/paie/elements-remuneration'),
                        NavigationItem::make('Paramètres & paiements')
                            ->url('/admin/paie/parametres-paiements'),
                        NavigationItem::make('Déclarations sociales')
                            ->url('/admin/paie/declarations-sociales'),
                    ]),
                    NavigationGroup::make('Documents')->items([
                        NavigationItem::make('Contrats & fiches de paie')
                            ->url('/admin/documents/contrats-paie'),
                        NavigationItem::make('Exports')
                            ->url('/admin/documents/exports'),
                    ]),
                    NavigationGroup::make('IA de gestion')->items([
                        NavigationItem::make('Assistant paie')
                            ->url('/admin/ia/assistant'),
                        NavigationItem::make('Modification intelligente')
                            ->url('/admin/ia/modification-intelligente'),
                        NavigationItem::make('Vérifications automatiques')
                            ->url('/admin/ia/verifications-auto'),
                        NavigationItem::make('Conseils RH')
                            ->url('/admin/ia/conseils-rh'),
                    ]),
                    NavigationGroup::make('Structure & Paramètres')->items([
                        NavigationItem::make('Établissement')
                            ->url('/admin/structure/etablissement'),
                        NavigationItem::make('Accès & notifications')
                            ->url('/admin/structure/acces-notifications'),
                        NavigationItem::make('Intégrations')
                            ->url('/admin/structure/integrations'),
                        NavigationItem::make('Imports multiples')
                            ->url('/admin/structure/imports-multiples'),
                    ]),
                ]);
            });
    }
}
