<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Construir la consulta base
        $query = User::query();

        // Aplicar filtros de búsqueda si se proporcionan
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%')
                ->orWhere('email', 'like', '%' . $request->input('search') . '%');
        }

        // Aplicar ordenamiento si se proporciona
        if ($request->has('sortBy') && $request->has('sortOrder')) {
            $query->orderBy($request->input('sortBy'), $request->input('sortOrder'));
        } else {
            $query->orderBy('created_at', 'desc'); // Orden por defecto
        }

        // Paginación
        $perPage = $request->input('perPage', 10); // Número de elementos por página (por defecto 10)
        $users = $query->paginate($perPage);

        // Respuesta JSON optimizada
        return response()->json([
            'data' => $users->items(),
            'current_page' => $users->currentPage(),
            'last_page' => $users->lastPage(),
            'per_page' => $users->perPage(),
            'total' => $users->total(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
