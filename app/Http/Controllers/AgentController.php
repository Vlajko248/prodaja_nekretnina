<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgentStoreRequest;
use App\Http\Requests\AgentUpdateRequest;
use App\Models\Agent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgentController extends Controller
{
    public function index(Request $request): Response
    {
        $agents = Agent::all();

        return view('agent.index', [
            'agents' => $agents,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('agent.create');
    }

    public function store(AgentStoreRequest $request): Response
    {
        $agent = Agent::create($request->validated());

        $request->session()->flash('agent.id', $agent->id);

        return redirect()->route('agents.index');
    }

    public function show(Request $request, Agent $agent): Response
    {
        return view('agent.show', [
            'agent' => $agent,
        ]);
    }

    public function edit(Request $request, Agent $agent): Response
    {
        return view('agent.edit', [
            'agent' => $agent,
        ]);
    }

    public function update(AgentUpdateRequest $request, Agent $agent): Response
    {
        $agent->update($request->validated());

        $request->session()->flash('agent.id', $agent->id);

        return redirect()->route('agents.index');
    }

    public function destroy(Request $request, Agent $agent): Response
    {
        $agent->delete();

        return redirect()->route('agents.index');
    }
}
