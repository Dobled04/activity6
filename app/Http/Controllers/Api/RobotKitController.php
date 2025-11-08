<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotKit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RobotKitController extends Controller
{
    public function index()
    {
        try {
            $kits = RobotKit::all();
            return response()->json([
                'success' => true,
                'data' => $kits,
                'message' => 'Kits obtenidos exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los kits: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'model' => 'required|string|max:100',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'is_available' => 'boolean'
            ]);

            $kit = RobotKit::create($validated);

            return response()->json([
                'success' => true,
                'data' => $kit,
                'message' => 'Kit creado exitosamente'
            ], Response::HTTP_CREATED);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el kit: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $kit = RobotKit::find($id);

            if (!$kit) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kit no encontrado'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'data' => $kit,
                'message' => 'Kit obtenido exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el kit: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $kit = RobotKit::find($id);

            if (!$kit) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kit no encontrado'
                ], Response::HTTP_NOT_FOUND);
            }

            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'description' => 'nullable|string',
                'model' => 'sometimes|required|string|max:100',
                'price' => 'sometimes|required|numeric|min:0',
                'stock' => 'sometimes|required|integer|min:0',
                'is_available' => 'boolean'
            ]);

            $kit->update($validated);

            return response()->json([
                'success' => true,
                'data' => $kit,
                'message' => 'Kit actualizado exitosamente'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el kit: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $kit = RobotKit::find($id);

            if (!$kit) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kit no encontrado'
                ], Response::HTTP_NOT_FOUND);
            }

            $kit->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kit eliminado exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el kit: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}