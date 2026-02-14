<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Projet extends Model
{
    protected $fillable = ['user_id', 'designation', 'nature', 'finance', 'delaiE', 'odsEtude', 'odsRealisation', 'dateReception', 'dateMiseEnOeuvre', 'montantAlloue', 'montantEC', 'montantPC', 'delaiR', 'etatPhysique', 'tauxA', 'observation'];

    protected $casts = [
        'odsEtude' => 'date:Y-m-d',
        'odsRealisation' => 'date:Y-m-d',
        'dateReception' => 'date:Y-m-d',
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function fromDateTime($value)
    {
        if ($value instanceof DateTimeInterface) {
            return $value->format('Y-m-d\TH:i:s');
        }

        return $value;
    }

    public function avancement()
    {

        return $this->hasMany('App\Avancement')
            ->orderBy('avancements.created_at', 'DESC');
    }

    public function retards()
    {

        return $this->hasMany('App\Retard');
    }

    public function images()
    {

        return $this->hasMany('App\Image');
    }

    public function user()
    {

        return $this->belongsTo('App\User');
    }

    public static function getNbNatureAllP($finance, string $nature, $year)
    {

        if ($finance == 'tout') {
            $a = Projet::selectRaw('count(*) as count')->where('nature', $nature)->where(function ($q) use ($year) {
                $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
            })->where(function ($q) use ($year) {
                $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                    $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                });
            })->first()->count;
        } else {
            $a = Projet::selectRaw('count(*) as count')->where([['nature', '=', $nature], ['finance', 'LIKE', '%' . $finance . '%']])->where(function ($q) use ($year) {
                $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
            })->where(function ($q) use ($year) {
                $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                    $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                });
            })->first()->count;
        }

        if ($a == null) {
            $a = '0';
        }

        return $a;
    }

    public static function getNbProjet(String $id, $year, $finance)
    {
        $user = User::find($id);
        if ($finance == 'tout') {

            $a = $user->projet()
                ->selectRaw('count(*) as count')
                ->where(function ($q) use ($year) {
                    $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
                })
                ->where(function ($q) use ($year) {
                    $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                        $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                    });
                })->first()->count;
        } else {
            $a = $user->projet()
                ->selectRaw('count(*) as count')
                ->where([['finance', 'LIKE', '%' . $finance . '%']])
                ->where(function ($q) use ($year) {
                    $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
                })
                ->where(function ($q) use ($year) {
                    $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                        $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                    });
                })->first()->count;
        }

        if ($a == null) {
            $a = '0';
        }

        return $a;
    }

    public static function getNbProjetT($finance, $year)
    {
        if ($finance == 'tout') {
            $a = Projet::selectRaw('count(*) as count ')->where(function ($q) use ($year) {
                $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
            })->where(function ($q) use ($year) {
                $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                    $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                });
            })->first()->count;
        } else {
            $a = Projet::selectRaw('count(*) as count ')->where('finance', 'LIKE', '%' . $finance . '%')->where(function ($q) use ($year) {
                $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
            })->where(function ($q) use ($year) {
                $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                    $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                });
            })->first()->count;
        }

        if ($a == null) {
            $a = '0';
        }

        return $a;
    }

    public static function getProjetsByFinanceNature($id, $year, $finance, $nature)
    {

        $user = User::find($id);

        if ($finance == 'tout') {
            $projets = $user->projet()
                ->where(['nature' => $nature])->where(function ($q) use ($year) {
                    $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
                })->where(function ($q) use ($year) {
                    $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                        $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                    });
                })->get();
        } else {
            $projets = $user->projet()
                ->where([['nature', '=', $nature], ['finance', 'LIKE', '%' . $finance . '%']])->where(function ($q) use ($year) {
                    $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
                })->where(function ($q) use ($year) {
                    $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                        $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                    });
                })->get();
        }

        foreach ($projets as $i => $p) {
            $lastDate = Carbon::parse($p->avancement->first()['created_at']);
            $diffDate = $lastDate->diffInDays(Carbon::now()) - Projet::delayDays($p);

            if ($diffDate >= 30) {
                $p->retard = true;
            } else {
                $p->retard = false;
            }
        }

        return $projets;
    }

    public static function totalMontant(String $id, $year, string $finance, string $nature, string $montant)
    {
        $user = User::find($id);

        if ($finance == 'tout') {

            $a = $user->projet()
                ->selectRaw('sum(' . $montant . ') as total')->where('nature', $nature)->where(function ($q) use ($year) {
                    $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
                })->where(function ($q) use ($year) {
                    $q->where(function ($q) use ($year) {
                        $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                            $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                        });
                    })->orWhere(function ($q) use ($year) {
                        $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                    });
                })->first()->total;
        } elseif ($finance == 'BE' || $finance == 'FP') {

            $a = $user->projet()
                ->selectRaw('sum(' . $montant . ') as total')->where('nature', $nature)->where('finance', 'LIKE', '%' . $finance . '%')->where(function ($q) use ($year) {
                    $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
                })->where(function ($q) use ($year) {
                    $q->where(function ($q) use ($year) {
                        $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                            $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                        });
                    })->orWhere(function ($q) use ($year) {
                        $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                    });
                })->first()->total;
        } else {
            $a = $user->projet()
                ->selectRaw('sum(' . $montant . ') as total')->where(['nature' => $nature, 'finance' => $finance])->where(function ($q) use ($year) {
                    $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
                })->where(function ($q) use ($year) {
                    $q->where(function ($q) use ($year) {
                        $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                            $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                        });
                    })->orWhere(function ($q) use ($year) {
                        $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                    });
                })->first()->total;
        }

        if ($a == null) {
            return '0';
        } else {
            return $a;
        }
    }

    public static function getCountEtat(String $id, $year, $finance, string $nature, string $etat)
    {

        $user = User::find($id);

        if ($finance == 'tout') {
            $a = $user->projet()
                ->selectRaw('count(etatPhysique) as total')
                ->where(['nature' => $nature, 'etatPhysique' => $etat])->where(function ($q) use ($year) {
                    $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
                })->where(function ($q) use ($year) {
                    $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                        $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                    });
                })->first()->total;
        } else {

            $a = $user->projet()
                ->selectRaw('count(etatPhysique) as total')
                ->where([['nature', '=', $nature], ['etatPhysique', '=', $etat], ['finance', 'LIKE', '%' . $finance . '%']])->where(function ($q) use ($year) {
                    $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
                })->where(function ($q) use ($year) {
                    $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                        $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                    });
                })->first()->total;
        }

        if ($a == null) {
            return '0';
        } else {
            return $a;
        }
    }

    public static function sumMontant(String $id, $year, $finance, string $montant)
    {

        $user = User::find($id);

        if ($finance == 'tout') {

            $a = $user->projet()
                ->selectRaw('sum(' . $montant . ') as total')->where(function ($q) use ($year) {
                    $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
                })->where(function ($q) use ($year) {
                    $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                        $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                    });
                })->first()->total;
        } else {

            $a = $user->projet()
                ->selectRaw('sum(' . $montant . ') as total')->where('finance', 'LIKE', '%' . $finance . '%')->where(function ($q) use ($year) {
                    $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
                })->where(function ($q) use ($year) {
                    $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                        $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                    });
                })->first()->total;
        }

        if ($a == null) {
            return '0';
        } else {
            return $a;
        }
    }

    public static function countEtatTotal(String $id, $year, $finance, string $etat)
    {
        $user = User::find($id);
        if ($finance == 'tout') {

            $a = $user->projet()
                ->selectRaw('count(etatPhysique) as total')
                ->where('etatPhysique', $etat)->where(function ($q) use ($year) {
                    $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
                })->where(function ($q) use ($year) {
                    $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                        $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                    });
                })->first()->total;
        } else {

            $a = $user->projet()
                ->selectRaw('count(etatPhysique) as total')
                ->where([['etatPhysique', '=', $etat], ['finance', 'LIKE', '%' . $finance . '%']])->where(function ($q) use ($year) {
                    $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
                })->where(function ($q) use ($year) {
                    $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                        $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                    });
                })->first()->total;
        }

        if ($a == null) {
            return '0';
        } else {
            return $a;
        }
    }

    public static function montantTotal($finance, string $montant, $year)
    {

        if ($finance == 'tout') {

            $a = Projet::selectRaw('sum(' . $montant . ') as total')->where(function ($q) use ($year) {
                $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
            })->where(function ($q) use ($year) {
                $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                    $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                });
            })->first()->total;
        } else {

            $a = Projet::selectRaw('sum(' . $montant . ') as total')->where('finance', 'LIKE', '%' . $finance . '%')->where(function ($q) use ($year) {
                $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
            })->where(function ($q) use ($year) {
                $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                    $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                });
            })->first()->total;
        }

        if ($a == null) {
            return '0';
        } else {
            return $a;
        }
    }

    public static function getRatioNatureEtat(string $nature, string $etat, $year)
    {
        $a = Projet::getNbNatureAllP('tout', $nature, $year);
        if ($a == 0) {
            return "0 %";
        }
        return round((Projet::getCountByNatureEtat($nature, $etat, $year) / $a) * 100, 2) . " %";
    }

    public static function getCountByNatureEtat(string $nature, string $etat, $year)
    {
        $a = Projet::selectRaw('count(etatPhysique) as total')->where(['nature' => $nature, 'etatPhysique' => $etat])->where(function ($q) use ($year) {
            $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
        })->where(function ($q) use ($year) {
            $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
            });
        })->first()->total;

        if ($a == null) {

            return '0';
        } else {
            return $a;
        }
    }

    public static function getEtatT(string $etat, $year)
    {
        $a = Projet::selectRaw('count(etatPhysique) as total')->where('etatPhysique', $etat)->where(function ($q) use ($year) {
            $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
        })->where(function ($q) use ($year) {
            $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
            });
        })->first()->total;

        if ($a == null) {
            return '0';
        } else {
            return $a;
        }
    }

    public static function getSumMontantByNature(string $nature, string $montant, $year)
    {
        $a = Projet::selectRaw('sum(' . $montant . ') as total')->where('nature', $nature)->where(function ($q) use ($year) {
            $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
        })->where(function ($q) use ($year) {
            $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
            });
        })->first()->total;

        if ($a == null) {
            return '0';
        } else {
            return $a;
        }
    }

    public static function delayDays(Projet $p)
    {
        $days = 0;
        $retards = $p->retards()
            ->where('type', 'realisation')
            ->orderBy('date_reprise', 'desc')
            ->get();

        if ($retards != "[]") {
            $r = $retards->first();

            $arret = Carbon::parse($p
                ->avancement
                ->first()['created_at']);
            $reprise = Carbon::parse($r->date_reprise);
            $days = $arret->diffInDays($reprise);
        }

        return $days;
    }

    public static function getCountEtatTotal($id, $year, $finance, $nature)
    {

        $etat = ['E', 'P', 'R', 'NL', 'A'];
        $e[] = array();
        foreach ($etat as $i => $n) {
            $e[$i] = Projet::getCountEtat($id, $year, $finance, $nature, $n);
        }

        return $e;
    }
    public static function totalMontantTotal(String $id, $year, string $finance, string $nature)
    {

        $montants = ['montantAlloue', 'montantEC', 'montantPC'];
        $e[] = array();
        foreach ($montants as $i => $n) {
            $e[$i] = Projet::totalMontant($id, $year, $finance, $nature, $n);
        }

        return $e;
    }

    public static function sumMontantG(String $id, $year, $finance)
    {

        $montants = ['montantAlloue', 'montantEC', 'montantPC'];
        $e[] = array();
        foreach ($montants as $i => $n) {
            $e[$i] = Projet::sumMontant($id, $year, $finance, $n);
        }

        return $e;
    }
    public static function countEtatTotalG(String $id, $year, $finance)
    {

        $etat = ['E', 'P', 'R', 'NL', 'A'];

        foreach ($etat as $i => $n) {
            $e[$n] = Projet::countEtatTotal($id, $year, $finance, $n);
        }

        return $e;
    }

    public static function countProjetByEtat($year)
    {

        $etat = ['E', 'P', 'R', 'NL', 'A'];

        foreach ($etat as $i => $n) {
            $e[$n] = Projet::getEtatT($n, $year);
        }

        return $e;
    }

    public static function getNbNatureP(string $finance, string $id, $year, string $nature)
    {
        if ($finance == 'tout') {
            $a = User::find($id)->projet()->selectRaw('count(*) as count')->where('nature', $nature)->where(function ($q) use ($year) {
                $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
            })->where(function ($q) use ($year) {
                $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                    $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                });
            })->first()->count;
        } else {
            $a = User::find($id)->projet()->selectRaw('count(*) as count')->where([['nature', '=', $nature], ['finance', 'LIKE', '%' . $finance . '%']])->where(function ($q) use ($year) {
                $q->whereYear('dateMiseEnOeuvre', $year)->orWhereNull('dateMiseEnOeuvre');
            })->where(function ($q) use ($year) {
                $q->whereYear('odsEtude', '<=', $year)->orWhere(function ($q) use ($year) {
                    $q->whereNull('odsEtude')->whereYear('created_at', '=', $year);
                });
            })->first()->count;
        }

        if ($a == null) {
            $a = '0';
        }

        return $a;
    }

    public static function tauxConsommation($id, $year, $finance)
    {
        $a = 0;
        $ma = Projet::sumMontant($id, $year, $finance, 'montantAlloue');
        if ($ma != 0) {
            $a = (Projet::sumMontant($id, $year, $finance, 'montantPC') / $ma) * 100;
        }
        return round($a, 2) . " %";
    }

    public static function tauxConsommationTotal($finance, $year)
    {
        $a = 0;
        $ma = Projet::montantTotal($finance, 'montantAlloue', $year);
        if ($ma != 0) {
            $a = (Projet::montantTotal($finance, 'montantPC', $year) / $ma) * 100;
        }
        return round($a, 2) . " %";
    }

    public static function projetNL($id, $year)
    {
        $a = Projet::countEtatTotal($id, $year, 'tout', 'E') + Projet::countEtatTotal($id, $year, 'tout', 'P') + Projet::countEtatTotal($id, $year, 'tout', 'NL');
        return $a;
    }

    public static function tauxProjetNL($id, $year)
    {
        $a = Projet::getNbProjet($id, $year, 'tout');
        if ($a != 0) {
            $a = (Projet::projetNL($id, $year) / $a) * 100;
        } else {
            $a = 0;
        }

        return round($a, 2) . " %";
        return $a;
    }

    public static function totalProjetNL($year)
    {
        $a = Projet::getEtatT('E', $year) + Projet::getEtatT('P', $year) + Projet::getEtatT('NL', $year);
        return $a;
    }

    public static function tauxTotalProjetNL($year)
    {
        $a = Projet::getNbProjetT('tout', $year);
        if ($a != 0) {
            $a = (Projet::totalProjetNL($year) / $a) * 100;
        } else {
            $a = 0;
        }

        return round($a, 2) . " %";
        return $a;
    }

    public static function tauxEngagement($id, $year, $finance)
    {
        $a = 0;
        $ma = Projet::sumMontant($id, $year, $finance, 'montantAlloue');
        if ($ma != 0) {
            $a = (Projet::sumMontant($id, $year, $finance, 'montantEC') / $ma) * 100;
        }
        return round($a, 2) . " %";
    }

    public static function tauxEngagementTotal($finance, $year)
    {
        $a = 0;
        $ma = Projet::montantTotal($finance, 'montantAlloue', $year);
        if ($ma != 0) {
            $a = (Projet::montantTotal($finance, 'montantEC', $year) / $ma) * 100;
        }
        return round($a, 2) . " %";
    }
}
