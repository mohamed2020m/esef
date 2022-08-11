<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    private $id;
    private $filier_name;

    public function __construct(int $id, string $filier_name) 
    {
        $this->id = $id;
        $this->filier_name = $filier_name;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return User::select("id", "last_name", "first_name", "cin", "cne")->get();
        // return DB::table('users')->select("users.id", "last_name", "first_name", "cin", "cne")
        // ->join('filiere_user','filiere_user.user_id','=','users.id')->get();
        // // ->join('filieres','filieres.id','=','filiere_user.filiere_id')->where('filieres.id',$id)->get();

        $data = DB::Table('users')->select('users.id', 'users.last_name', 'users.first_name', 'users.last_name_arabic', 'users.first_name_arabic')
        ->join('filiere_user','filiere_user.user_id','=','users.id')
        ->join('filieres','filieres.id','=','filiere_user.filiere_id')
        ->where('filiere_user.filiere_id', $this->id)
        ->get();

        foreach ($data as $candidat) {
            $total_note_matiere=0;
            $total_coefficient_matiere=0;
            $note_partie_bac=0;
            $note_partie_licence=0;
            $coefficient_bac=0;
            $coefficient_licence=0;
            $cuurent_school_year = date("Y") - 1;
            $year_of_graduation = date("Y") - 1;
            $n_matiere = 0;
            $n_matiere_note = 0;

            $matieres=DB::table('matiere_user')->select('matiere_user.*', 'matieres.name')
            ->join('matieres','matieres.id','=','matiere_user.matiere_id')
            ->where('matiere_user.user_id',$candidat->id)
            ->get();
            
            $currrent_matieres_In_current_filiere = DB::table('filiere_matiere')->select('matiere_id')
            ->where('filiere_matiere.filiere_id', $this->id)
            ->get()->toArray();

            $currrent_matieres_In_current_filiere = array_values($currrent_matieres_In_current_filiere);
            $no_double_matieres = [];
            foreach($matieres as $matiere){
                if(!(in_array($matiere->matiere_id, $no_double_matieres)) && in_array($matiere->matiere_id, $currrent_matieres_In_current_filiere))
                {
                    array_push($no_double_matieres, $matiere->matiere_id);
                    $n_matiere++;
                    $n_matiere_note ++;
                    $coefficient=DB::table('filiere_matiere')->select('filiere_matiere.*')
                    ->where('filiere_matiere.filiere_id', $this->id)
                    ->where('filiere_matiere.matiere_id', $matiere->matiere_id)
                    ->first();
    
                    $count =  "note-" . $n_matiere_note;
    
                    if($coefficient){
                        $produit_matiere_coefficient = ($matiere->note)*($coefficient->coefficient_matiere);
                        $total_note_matiere += $produit_matiere_coefficient;
                        $total_coefficient_matiere += $coefficient->coefficient_matiere;  
                            
                        $candidat->$n_matiere = $matiere->name;
                        $candidat->$count = $matiere->note;
                    }
                    else{
                        $candidat->$n_matiere = "vide";
                        $candidat->$count = "vide";
                    }
                }

            }
            //note du partie bac avant l'ajout du bonus
            if ($total_coefficient_matiere){
                $note_partie_bac = $total_note_matiere/$total_coefficient_matiere;
            }

            // adding Bonus
            $bac=DB::table('bac_filiere')->select('bac_filiere.*')
            ->join('bac_user','bac_user.bac_id','=','bac_filiere.bac_id')
            ->where('bac_filiere.filiere_id',$this->id)
            ->where('bac_user.user_id',$candidat->id)
            ->first();

            if($bac){
                $note_partie_bac += $bac->bonus_bac;
                $coefficient_bac = $bac->coefficient_bac;
            }

            $year_of_graduation = DB::table('bac_user')->select('bac_user.annee_obtention', 'bacs.name')
            ->join('bacs','bacs.id','=','bac_user.bac_id')
            ->where('bac_user.user_id', $candidat->id)
            ->first();

            $candidat->type_de_bac = $year_of_graduation->name;
            $candidat->annee_obtention = $year_of_graduation->annee_obtention;

            //NOTE DU PARTIE BAC APRES l'ajout du bonus 
            $licence=DB::table('licence_user')->select('licence_user.*', 'licences.name')
            ->join('licences','licences.id','=','licence_user.licence_id')
            ->where('licence_user.user_id', $candidat->id)
            ->first();
            
            if($licence){
                $note_partie_licence = (($licence->note_s1)+($licence->note_s2))/2;
                
                $candidat->Note_S1 = $licence->note_s1;
                $candidat->Note_S2 = $licence->note_s2;
                $candidat->type_licence = $licence->name;
            }
            else{
                $candidat->Note_S1 = "vide";
                $candidat->Note_S2 = "vide";
                $candidat->type_licence = "vide";
            }


            // // adding Bonus to licence
            $bonus=DB::table('filiere_licence')->select('filiere_licence.*')
            ->join('licence_user','licence_user.licence_id',"=",'filiere_licence.licence_id')
            ->where('filiere_licence.filiere_id', $this->id)
            ->where('licence_user.user_id',$candidat->id)
            ->first();

            if($bonus){
                $note_partie_licence+=$bonus->bonus_licence;
                $coefficient_licence=$bonus->coefficient_licence;
            }

            $coeff_total = $coefficient_bac+$coefficient_licence;
            if($coeff_total){
                $score = (($note_partie_bac*$coefficient_bac)+($note_partie_licence*$coefficient_licence))/$coeff_total;
                if($cuurent_school_year != $year_of_graduation->annee_obtention){
                    $score -= 1;
                }
            }
            $candidat->score = round($score, 2);
        }

        $sortData = $data->sortBy('score')->reverse();

        return $sortData;
    }   

    public function headings(): array
    {
        $s_arr =  ["ID", "Nom", "PRÉNOM", "الاسم العائلي", "الاسم الاول"];
        $s_last = ["Type de Bac" ,"L'année d'obtention", "Note_S1", "Note_S2" , "Type de Licence", "Score"];
        $d_arr = ["Matières-1", "Note-1", "Matières-2", "Note-2", "Matières-3", "Note-3"];

        $app_arr = array_merge($s_arr, $d_arr, $s_last);
        return [
            [$this->filier_name],
            $app_arr
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class  => function(AfterSheet $event) {
                // title
                $event->sheet->getDelegate()->getStyle('A1:Q2')->getFont()->setSize(20);
                $event->sheet->mergeCells('A1:Q1');
                $event->sheet->getDelegate()->getStyle('A1:Q1')->getFill()->applyFromArray(
                    [
                        'font' => array(
                            'name'      =>  'Calibri',
                            'bold'      =>  true,
                            'color' => ['argb' => 'EB2B02'],
                        )
                    ]
                );
                // table
                $event->sheet->getDelegate()->getStyle('A2:Q2')->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle('A2:Q2')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'D9D9D9']]);
                $event->sheet->getStyle('A1:A100000')->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle('B1:Q2')->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle('A1:A100000')->getAlignment()->setVertical('center');
                $event->sheet->getStyle('B1:Q2')->getAlignment()->setVertical('center');
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(60);
                $event->sheet->getDelegate()->getRowDimension('2')->setRowHeight(30);  
            },
        ];
    }
}
