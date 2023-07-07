<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Etudiant;

class EtudiantController extends Controller
{
    public function list_etudiant(){

        $etudiants = Etudiant::paginate(1);
        return view('etudiant.liste', compact('etudiants'));
    }

    public function ajouter_etudiant(){
        return view('etudiant.ajouter');
    }

    public function ajouter_etudiant_traitmenet(Request $request){
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'classe' => 'required',
        ]);

        $etudiant = new Etudiant();
        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->classe = $request->classe;
        $etudiant->save();

        return redirect('/ajouter')->with('status', 'bien ajoute');
    }

    public function update_etudiant($id){

        $etudiants = Etudiant::find($id);

        return view('etudiant.update', compact('etudiants'));
    }

    public function update_etudiant_traitmenet(Request $request){
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'classe' => 'required',
        ]);

        $etudiant = Etudiant::find($request->id);
        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->classe = $request->classe;
        $etudiant->update();

        return redirect('/etudiant')->with('status', 'bien modifie');
    }

    public function delete_etudiant($id){
        $etudiant = Etudiant::find($id);
        $etudiant->delete();
        return redirect('/etudiant')->with('status', 'bien supprime');
    }
}
