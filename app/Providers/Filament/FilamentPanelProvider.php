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
            ->homeUrl('/admin/home')
            ->navigation(function (NavigationBuilder $navigation): NavigationBuilder {
                return $navigation->groups([
                    NavigationGroup::make('Tableau de bord')->items([
                        NavigationItem::make('Actions rapides')
                            ->icon('heroicon-o-rocket')
                            ->url('/admin/dashboard/actions-rapides'),
                        NavigationItem::make('Indicateurs clés')
                            ->icon('heroicon-o-chart-bar')
                            ->url('/admin/dashboard/indicateurs'),
                    ]),
                    NavigationGroup::make('Collaborateurs')->items([
                        NavigationItem::make('Liste des Collaborateurs')
                            ->icon('heroicon-o-users')
                            ->url('/admin/collaborateurs'),
                    ]),
                    NavigationGroup::make('Temps de travail & absences')->items([
                        NavigationItem::make('Congés & absences')
                            ->icon('heroicon-o-calendar')
                            ->url('/admin/absences'),
                    ]),
                    NavigationGroup::make('Paie')->items([
                        NavigationItem::make('Clôturer la paie')
                            ->icon('heroicon-o-currency-euro')
                            ->url('/admin/paie/cloturer'),
                        NavigationItem::make('Éléments de rémunération')
                            ->icon('heroicon-o-banknotes')
                            ->url('/admin/paie/elements-remuneration'),
                        NavigationItem::make('Paramètres & paiements')
                            ->icon('heroicon-o-cog')
                            ->url('/admin/paie/parametres-paiements'),
                        NavigationItem::make('Déclarations sociales')
                            ->icon('heroicon-o-document-text')
                            ->url('/admin/paie/declarations-sociales'),
                    ]),
                    NavigationGroup::make('Documents')->items([
                        NavigationItem::make('Contrats & fiches de paie')
                            ->icon('heroicon-o-document')
                            ->url('/admin/documents/contrats-paie'),
                        NavigationItem::make('Exports')
                            ->icon('heroicon-o-arrow-down-tray')
                            ->url('/admin/documents/exports'),
                    ]),
                    NavigationGroup::make('IA de gestion')->items([
                        NavigationItem::make('Assistant paie')
                            ->icon('heroicon-o-sparkles')
                            ->url('/admin/ia/assistant'),
                        NavigationItem::make('Modification intelligente')
                            ->icon('heroicon-o-pencil-square')
                            ->url('/admin/ia/modification-intelligente'),
                        NavigationItem::make('Vérifications automatiques')
                            ->icon('heroicon-o-shield-check')
                            ->url('/admin/ia/verifications-auto'),
                        NavigationItem::make('Conseils RH')
                            ->icon('heroicon-o-light-bulb')
                            ->url('/admin/ia/conseils-rh'),
                    ]),
                    NavigationGroup::make('Structure & Paramètres')->items([
                        NavigationItem::make('Établissement')
                            ->icon('heroicon-o-building-office')
                            ->url('/admin/structure/etablissement'),
                        NavigationItem::make('Accès & notifications')
                            ->icon('heroicon-o-bell')
                            ->url('/admin/structure/acces-notifications'),
                        NavigationItem::make('Intégrations')
                            ->icon('heroicon-o-link')
                            ->url('/admin/structure/integrations'),
                        NavigationItem::make('Imports multiples')
                            ->icon('heroicon-o-arrow-up-tray')
                            ->url('/admin/structure/imports-multiples'),
                    ]),
                ]);
            });
    }
}

