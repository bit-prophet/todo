<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $todosCollection = TodoResource::collection(
            Todo::query()->forUser()->get()
        );

        return response()->json($todosCollection);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        // Get the ID of the current authenticated user
        $userId = Auth::id();

        // Add the user_id to the validated data
        $validatedData['user_id'] = $userId;

        $todo = Todo::query()->create($validatedData);

        return response()->json(new TodoResource($todo), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo): JsonResponse
    {
        $this->authorize('view', $todo);

        return response()->json(new TodoResource($todo));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo): JsonResponse
    {
        $this->authorize('update', $todo);

        $validatedData = $request->validated();

        $todo->update($validatedData);

        return response()->json(new TodoResource($todo));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo): JsonResponse
    {
        $this->authorize('delete', $todo);

        $todo->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Toggle the completed status of the specified to-do.
     */
    public function toggleCompleted(Request $request, Todo $todo): JsonResponse
    {
        $this->authorize('update', $todo);

        $todo->update([
            'completed' => !$todo->completed,
        ]);

        return response()->json([
            'message' => 'Todo completed status toggled successfully',
            'todo' => new TodoResource($todo)
        ]);
    }
}
