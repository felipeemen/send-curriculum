<?php

namespace App\Http\Controllers;

use App\Http\Enums\Education;
use App\Jobs\SendCurriculumEmail;
use App\Models\Curriculum;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educations = Education::options();
        return inertia('Home/Index', [
            'educations' => $educations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|phone:BR',
                'position' => 'required',
                'education' => 'required',
                'observations' => 'nullable|string|max:255',
                'file' => 'required|file|mimes:pdf,doc,docx|max:1024',
            ], [
                'name.required' => 'O nome é obrigatório.',
                'email.required' => 'O email é obrigatório.',
                'email.email' => 'O email deve ser um endereço de email válido.',
                'phone.required' => 'O telefone é obrigatório.',
                'phone.phone' => 'O telefone deve ser um número de telefone válido.',
                'position.required' => 'A posição desejada é obrigatória.',
                'education.required' => 'O nível de educação é obrigatório.',
                'file.required' => 'O arquivo de currículo é obrigatório.',
                'file.max' => 'O arquivo deve ter no máximo 1MB.',
                'file.mimes' => 'O arquivo deve ser um PDF ou DOC/DOCX.',
                'observations.max' => 'Observações muito longas.',
            ]);

            if($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = uniqid('cv_', true) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('curriculums', $fileName, 'public');
                $validated['file_name'] = $fileName;
                $validated['file_path'] = $filePath;
                $validated['ip_address'] = $request->ip();
                $curriculum = Curriculum::create($validated);
                SendCurriculumEmail::dispatch($curriculum);
                return redirect()->route('home')->with('success', 'Currículo enviado com sucesso!');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
