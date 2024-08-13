<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PagesControllerNoApi extends Controller
{
    public function index()
    {
        try {
            $pages = Page::all();
            return view('pages.index', compact('pages'));
        } catch (\Exception $e) {
            return redirect('/pages')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $pages = Page::all();
            return view('pages.create', compact('pages'));
        } catch (\Exception $e) {
            return redirect('/pages')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'page' => 'required|string|max:255|unique:pages',
                'description' => 'required|string',
                'name' => 'required|string|max:255',
            ], [
                '*.required' => "Debe rellenar todos los campos (:attribute)",
            ]);
            $page = new Page();
            $page->page = $request->input('page');
            $page->description = $request->input('description');
            $page->name = $request->input('name');
            $page->save();
            return redirect('/pages')->with('success', 'Se creó correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return redirect('/pages')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $page = Page::find($id);
            return view('pages.edit', compact('page'));
        } catch (\Exception $e) {
            return back()->withError("No se encontró el pages.");
        }
    }
    public function show($id)
    {
        try {
            $page = Page::find($id);
            return view('pages.show', compact('page'));
        } catch (\Exception $e) {
            return back()->withError("No se encontró el pages.");
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'page' => 'required|string|max:255|unique:pages,page,' . $id,
                'description' => 'required|string',
                'name' => 'required|string|max:255',
            ], [
                '*.required' => "Debe rellenar todos los campos (:attribute)",
            ]);
            $page = Page::find($id);
            $page->page = $request->input('page');
            $page->description = $request->input('description');
            $page->name = $request->input('name');
            $page->save();
            return redirect('/pages')->with('success', 'Se actualizó correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return redirect('/pages')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $page = Page::find($id);
            $page->delete();
            return redirect('/pages')->with('success', 'Se eliminó correctamente');
        } catch (\Exception $e) {
            return redirect('/pages')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }
}
