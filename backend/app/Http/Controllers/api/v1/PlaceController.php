<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Place;
use App\Http\Resources\PlaceResource;
use App\Http\Resources\PlaceCollection;
use App\Http\Requests\PlaceUpdateRequest;
use App\Http\Requests\PlaceStoreRequest;

class PlaceController extends Controller
{
    public function __construct()
    {
        // Protects all routes except 'index' and 'show'
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    /**
     * List of approved public places.
     */
    public function index(): JsonResponse
    {
        $places = Place::query()
            ->where('pending', false)
            ->orderBy('id', 'asc')
            ->get();

        return response()->json(new PlaceCollection($places), Response::HTTP_OK);
    }

    /**
     * Show a single place.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $place = Place::findOrFail($id);
            return response()->json(new PlaceResource($place), Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Place not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Creation of a new place (admin and subadmin only).
     */
    public function store(PlaceStoreRequest $request): JsonResponse
    {
        if (Gate::denies('secondLevel')) {
            return response()->json([
                'error' => 'Unauthorized access'
            ], Response::HTTP_FORBIDDEN);
        }

        try {
            $data = $request->validated();
            $place = Place::create($data);

            Log::info('New place created', [
                'place_id' => $place->id,
                'user_id' => auth()->id(),
                'ip' => $request->ip(),
            ]);

            return response()->json(new PlaceResource($place), Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            Log::error('Error - creating place', [
                'user_id' => auth()->id(),
                'ip' => $request->ip(),
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'error' => '500 Error - creating place'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update place (admin, subadmin, moderator).
     */
    public function update(PlaceUpdateRequest $request, Place $place): JsonResponse
    {
        if (Gate::denies('thirdLevel')) {
            return response()->json([
                'error' => 'Unauthorized access'
            ], Response::HTTP_FORBIDDEN);
        }

        try {
            $data = $request->validated();
            $place->update($data);

            Log::info('Place updated', [
                'place_id' => $place->id,
                'user_id' => auth()->id(),
                'ip' => $request->ip(),
            ]);

            return response()->json(new PlaceResource($place), Response::HTTP_OK);
        } catch (\Throwable $e) {
            Log::error('Error - updating place', [
                'place_id' => $place->id ?? null,
                'user_id' => auth()->id(),
                'ip' => $request->ip(),
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'error' => '500 Error - updating place'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete place (admin and subadmin only).
     */
    public function destroy(Request $request, Place $place): JsonResponse
    {
        if (Gate::denies('secondLevel')) {
            return response()->json([
                'error' => 'Unauthorized access'
            ], Response::HTTP_FORBIDDEN);
        }

        try {
            $placeId = $place->id;
            $place->delete();

            Log::warning('Place deleted', [
                'place_id' => $placeId,
                'user_id' => auth()->id(),
                'ip' => $request->ip(),
            ]);

            return response()->json([
                'message' => 'Place deleted correctly.'
            ], Response::HTTP_OK);
        } catch (\Throwable $e) {
            Log::error('Error - deleting place', [
                'place_id' => $place->id ?? null,
                'user_id' => auth()->id(),
                'ip' => $request->ip(),
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'error' => '500 Error - deleting place.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}