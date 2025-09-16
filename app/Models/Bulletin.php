<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bulletin extends Model
{
    protected $fillable = [
        'salarie_id',
        'periode',
        'heures_supplementaires',
        'primes',
        'absences',
        'retenues',
        'net_imposable',
        'net_a_payer_avant_impot',
        'impot_source',
        'net_a_payer',
        'cumul_imposable',
        'cumul_net',
        'date_paiement',
        'pdf_path',
    ];

    protected $casts = [
        'periode' => 'date',
        'heures_supplementaires' => 'decimal:2',
        'primes' => 'decimal:2',
        'absences' => 'decimal:2',
        'retenues' => 'decimal:2',
        'net_imposable' => 'decimal:2',
        'net_a_payer_avant_impot' => 'decimal:2',
        'impot_source' => 'decimal:2',
        'net_a_payer' => 'decimal:2',
        'cumul_imposable' => 'decimal:2',
        'cumul_net' => 'decimal:2',
        'date_paiement' => 'date',
    ];

    public function salarie(): BelongsTo
    {
        return $this->belongsTo(Salarie::class);
    }

    public function calculatePayroll()
    {
        $contrat = $this->salarie->contrat;
        $convention = $contrat->conventionCollective;

        $brut = $contrat->salaire_base
            + ($this->heures_supplementaires * $contrat->taux_horaire) // majoration à appliquer selon règles
            + $this->primes
            - $this->absences
            - $this->retenues;

        // Cotisations salariales et patronales à calculer selon $convention (à personnaliser)
        $cotisations_salariales = 0; // placeholder
        $cotisations_patronales = 0; // placeholder

        $net_imposable = $brut - $cotisations_salariales;
        $net_a_payer_avant_impot = $net_imposable;
        $impot_a_la_source = $net_imposable * ($this->salarie->taux_pas ?? 0);
        $net_a_payer = $net_a_payer_avant_impot - $impot_a_la_source;

        // Calculs cumulés annuels (à personnaliser)
        $cumul_imposable = 0;
        $cumul_net = 0;

        $this->net_imposable = $net_imposable;
        $this->net_a_payer_avant_impot = $net_a_payer_avant_impot;
        $this->impot_source = $impot_a_la_source;
        $this->net_a_payer = $net_a_payer;
        $this->cumul_imposable = $cumul_imposable;
        $this->cumul_net = $cumul_net;
    }
}
