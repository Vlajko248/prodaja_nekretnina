<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgentStoreRequest;
use App\Http\Requests\AgentUpdateRequest;
use App\Models\Agent;
use Illuminate\Http\Request;

/**
 * AgentController
 *
 * Handles CRUD operations for agents.
 * Views: agenti.index, agenti.create, agenti.show, agenti.edit
 * Routes (resource): agenti.index, agenti.create, agenti.store, agenti.show, agenti.edit, agenti.update, agenti.destroy
 */
class AgentController extends Controller
{
    /**
     * Display a listing of agents.
     * Route: agenti.index
     */
    public function index(Request $request): Response
    {
        $agents = Agent::all();

        return view('agenti.index', [
            'agents' => $agents,
        ]);
    }

    /**
     * Show the form for creating a new agent.
     * Route: agenti.create
     */
    public function create(Request $request): Response
    {
        return view('agenti.create');
    }

    /**
     * Store a newly created agent in storage.
     * Route: agenti.store
     *
     * @param  AgentStoreRequest  $request  Validated agent data
     * @return Response Redirect to agenti.index
     */
    public function store(AgentStoreRequest $request): Response
    {
        $agent = Agent::create($request->validated());

        $request->session()->flash('agent.id', $agent->id);

        return redirect()->route('agenti.index');
    }

    /**
     * Display the specified agent.
     * Route: agenti.show
     */
    public function show(Request $request, Agent $agent): Response
    {
        return view('agenti.show', [
            'agent' => $agent,
        ]);
    }

    /**
     * Show the form for editing the specified agent.
     * Route: agenti.edit
     */
    public function edit(Request $request, Agent $agent): Response
    {
        return view('agenti.edit', [
            'agent' => $agent,
        ]);
    }

    /**
     * Update the specified agent in storage.
     * Route: agenti.update
     *
     * @param  AgentUpdateRequest  $request  Validated agent data
     * @return Response Redirect to agenti.index
     */
    public function update(AgentUpdateRequest $request, Agent $agent): Response
    {
        $agent->update($request->validated());

        $request->session()->flash('agent.id', $agent->id);

        return redirect()->route('agenti.index');
    }

    /**
     * Remove the specified agent from storage.
     * Route: agenti.destroy
     *
     * @return Response Redirect to agenti.index
     */
    public function destroy(Request $request, Agent $agent): Response
    {
        $agent->delete();

        return redirect()->route('agenti.index');
    }
}
