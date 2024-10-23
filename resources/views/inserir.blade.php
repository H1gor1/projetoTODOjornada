<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-do list</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>

<body style="display: flex; width: 100vw; height: 100vh; align-items: center; justify-content: center;">
    <div class="container scrollable-div shadow-lg rounded" style="width: 65%; max-height: 75%; height: 75%; overflow: auto;">
        <div class="sticky-top" style="background-color: white; z-index: 10;">
            <ul class="nav nav-underline">
                {{-- Tab para inserção --}}
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="insert-tab" data-bs-toggle="tab" data-bs-target="#insert-tab-pane" type="button" role="tab" aria-controls="insert-tab-pane" aria-selected="true">Inserir tarefa</button>
                </li>
                
                {{-- Tab das tarefas não concluídas --}}
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="undone-tab" data-bs-toggle="tab" data-bs-target="#undone-tab-pane" type="button" role="tab" aria-controls="undone-tab-pane" aria-selected="true">Não concluidas</button>
                </li>

                {{-- Tab das tarefas concluídas --}}
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="done-tab" data-bs-toggle="tab" data-bs-target="#done-tab-pane" type="button" role="tab" aria-controls="done-tab-pane" aria-selected="true">Concluídas</button>
                </li>

                {{-- Tab das tarefas excluídas --}}
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="deleted-tab" data-bs-toggle="tab" data-bs-target="#deleted-tab-pane" type="button" role="tab" aria-controls="deleted-tab-pane" aria-selected="true">Deletadas</button>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="tab-content">
            {{-- Conteúdo da tab de inserção --}}
            <div class="tab-pane fade show active" id="insert-tab-pane" role="tabpanel" aria-labelledby="insert-tab" tabindex="0">
                <form action="/inserir" method="post">
                    @csrf
                    
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" id="titulo" class="form-control" name="titulo" placeholder="Título">
                        <label for="titulo">Título da tarefa</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea name="observacoes" id="observacoes" class="form-control" style="height: 100px" placeholder="Observações"></textarea>
                        <label for="observacoes">Observações</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prioridade</label>

                        <div class="form-check">
                            <input type="radio" name="prioridade" id="1" class="form-check-input" value="1">
                            <label for="1" class="form-check-label">1 (Maior prioridade)</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" name="prioridade" id="2" class="form-check-input" value="2">
                            <label for="2" class="form-check-label">2</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" name="prioridade" id="3" class="form-check-input" value="3">
                            <label for="3" class="form-check-label">3</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" name="prioridade" id="4" class="form-check-input" value="4">
                            <label for="4" class="form-check-label">4</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" name="prioridade" id="5" class="form-check-input" value="5">
                            <label for="5" class="form-check-label">5 (Menor prioridade)</label>
                        </div>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" role="switch" id="concluido" name="concluido" value="1">
                        <label class="form-check-label" for="concluido">Marcar tarefa como já concluída</label>
                      </div>
        
                    <div class="mb-3">
                        <button type="submit" class="btn btn-warning">Cadastrar tarefa</button>
                    </div>
                </form>
            </div>

            {{-- Conteúdo da tab de tarefas não concluídas --}}
            <div class="tab-pane fade" id="undone-tab-pane" role="tabpanel" aria-labelledby="undone-tab" tabindex="0">
                @if ($tasks->isNotEmpty())
                    <div class="row">
                        @foreach ($tasks as $task)
                            <div class="card m-3" style="width: 30%;">
                                <div class="card-body">
                                <h5 class="card-title">{{ $task->titulo }} <span class="badge text-bg-{{ $task->prioridade <= 2 ? 'success' : ($task->prioridade <= 4 ? 'warning' : 'danger') }}">{{ $task->prioridade }}</span></h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">
                                    <span>
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-writing"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 17v-12c0 -1.121 -.879 -2 -2 -2s-2 .879 -2 2v12l2 2l2 -2z" /><path d="M16 7h4" /><path d="M18 19h-13a2 2 0 1 1 0 -4h4a2 2 0 1 0 0 -4h-3" /></svg>
                                    </span>
                                    {{ $task->created_at->format('d/m/Y, H:i') }}
                                </h6>
                                <p class="card-text">{{ $task->observacoes }}</p>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <form action="/concluir/{{ $task->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
    
                                            <button class="btn btn-success" style="width: 100%;" type="submit">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-dashed-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.56 3.69a9 9 0 0 0 -2.92 1.95" /><path d="M3.69 8.56a9 9 0 0 0 -.69 3.44" /><path d="M3.69 15.44a9 9 0 0 0 1.95 2.92" /><path d="M8.56 20.31a9 9 0 0 0 3.44 .69" /><path d="M15.44 20.31a9 9 0 0 0 2.92 -1.95" /><path d="M20.31 15.44a9 9 0 0 0 .69 -3.44" /><path d="M20.31 8.56a9 9 0 0 0 -1.95 -2.92" /><path d="M15.44 3.69a9 9 0 0 0 -3.44 -.69" /><path d="M9 12l2 2l4 -4" /></svg>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="col-md-4">
                                        <form action="/deletar/{{ $task->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
    
                                            <button class="btn btn-danger" style="width: 100%;" type="submit">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                            </button>
                                        </form>
                                    </div>

                                    {{-- Editar informações --}}
                                <div class="col-md-4">
                                    <button class="btn btn-warning" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#editNotDoneModal">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                    </button>
                                </div>

                                {{-- Modal de edição --}}
                                <div class="modal fade" id="editNotDoneModal" tabindex="-1" aria-labelledby="editNotDoneModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="editNotDoneModalLabel">Editar informações da tarefa #{{ $task->id }}</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          {{-- Formulário de edição --}}

                                          <form action="/atualizar/{{ $task->id }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                
                                                <div class="form-floating mb-3">
                                                    <input type="text" id="titulo" class="form-control" name="titulo" placeholder="Título" value="{{ $task->titulo }}">
                                                    <label for="titulo">Título da tarefa</label>
                                                </div>
                            
                                                <div class="form-floating mb-3">
                                                    <textarea name="observacoes" id="observacoes" class="form-control" style="height: 100px" placeholder="Observações">{{ $task->observacoes }}</textarea>
                                                    <label for="observacoes">Observações</label>
                                                </div>
                            
                                                <div class="mb-3">
                                                    <label class="form-label">Prioridade</label>
                            
                                                    <div class="form-check">
                                                        <input type="radio" name="prioridade" id="1notdoneEdit" class="form-check-input" value="1" {{ $task->prioridade == 1 ? 'checked' : '' }}>
                                                        <label for="1" class="form-check-label">1 (Maior prioridade)</label>
                                                    </div>
                            
                                                    <div class="form-check">
                                                        <input type="radio" name="prioridade" id="2notdoneEdit" class="form-check-input" value="2" {{ $task->prioridade == 2 ? 'checked' : '' }}>
                                                        <label for="2" class="form-check-label">2</label>
                                                    </div>
                            
                                                    <div class="form-check">
                                                        <input type="radio" name="prioridade" id="3notdoneEdit" class="form-check-input" value="3" {{ $task->prioridade == 3 ? 'checked' : '' }}>
                                                        <label for="3" class="form-check-label">3</label>
                                                    </div>
                            
                                                    <div class="form-check">
                                                        <input type="radio" name="prioridade" id="4notdoneEdit" class="form-check-input" value="4" {{ $task->prioridade == 4 ? 'checked' : '' }}>
                                                        <label for="4" class="form-check-label">4</label>
                                                    </div>
                            
                                                    <div class="form-check">
                                                        <input type="radio" name="prioridade" id="5notdoneEdit" class="form-check-input" value="5" {{ $task->prioridade == 5 ? 'checked' : '' }}>
                                                        <label for="5" class="form-check-label">5 (Menor prioridade)</label>
                                                    </div>
                                                </div>
                            
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="concluido" name="concluido" value="1" {{ $task->concluido == true ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="concluido">Marcar tarefa como já concluída</label>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Salvar alterações</button>
                                        </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
                                </div>
                            </div>
                            @endforeach
                    </div>
                
                @else
                    <div class="alert alert-info mt-3">
                        <span>
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mood-wink"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M15 10h.01" /><path d="M9.5 15a3.5 3.5 0 0 0 5 0" /><path d="M8.5 8.5l1.5 1.5l-1.5 1.5" /></svg>
                        </span>
                        Não há nenhuma tarefa não concluída no momento! Quando houver, elas serão mostradas aqui.
                    </div>
                @endif
            </div>

            {{-- Conteúdo da tab de tarefas concluídas --}}
            <div class="tab-pane fade" id="done-tab-pane" role="tabpanel" aria-labelledby="done-tab" tabindex="0">
                @if ($completedTasks->isNotEmpty())
                <div class="row">
                    @foreach ($completedTasks as $task)
                        <div class="card m-3" style="width: 30%;">
                            <div class="card-body">
                              <h5 class="card-title">{{ $task->titulo }} <span class="badge text-bg-{{ $task->prioridade <= 2 ? 'success' : ($task->prioridade <= 4 ? 'warning' : 'danger') }}">{{ $task->prioridade }}</span></h5>
                              <h6 class="card-subtitle mb-2 text-body-secondary">
                                <span>
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-dashed-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.56 3.69a9 9 0 0 0 -2.92 1.95" /><path d="M3.69 8.56a9 9 0 0 0 -.69 3.44" /><path d="M3.69 15.44a9 9 0 0 0 1.95 2.92" /><path d="M8.56 20.31a9 9 0 0 0 3.44 .69" /><path d="M15.44 20.31a9 9 0 0 0 2.92 -1.95" /><path d="M20.31 15.44a9 9 0 0 0 .69 -3.44" /><path d="M20.31 8.56a9 9 0 0 0 -1.95 -2.92" /><path d="M15.44 3.69a9 9 0 0 0 -3.44 -.69" /><path d="M9 12l2 2l4 -4" /></svg>
                                </span>
                                {{ date('d/m/Y, H:i', strtotime($task->data_conclusao)) }}</h6>
                              <p class="card-text">{{ $task->observacoes }}</p>
                              
                              <div class="row">
                                
                                {{-- Marcar como não concluído --}}
                                <div class="col-md-4">
                                    <form action="/desconcluir/{{ $task->id }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-info me-2" style="width: 100%" type="submit">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-corner-up-left-double"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 18v-6a3 3 0 0 0 -3 -3h-7" /><path d="M13 13l-4 -4l4 -4m-5 8l-4 -4l4 -4" /></svg>
                                        </button>
                                    </form>
                                </div>

                                {{-- Exluir (mandar para a lixeira) --}}
                                <div class="col-md-4">
                                    <form action="/deletar/{{ $task->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger" style="width: 100%" type="submit">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        </button>
                                    </form>
                                </div>

                                {{-- Editar informações --}}
                                <div class="col-md-4">
                                    <button class="btn btn-warning" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#editDoneModal">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                    </button>
                                </div>

                                {{-- Modal de edição --}}
                                <div class="modal fade" id="editDoneModal" tabindex="-1" aria-labelledby="editDoneModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="editDoneModalLabel">Editar informações da tarefa #{{ $task->id }}</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          {{-- Formulário de edição --}}

                                          <form action="/atualizar/{{ $task->id }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                
                                                <div class="form-floating mb-3">
                                                    <input type="text" id="titulo" class="form-control" name="titulo" placeholder="Título" value="{{ $task->titulo }}">
                                                    <label for="titulo">Título da tarefa</label>
                                                </div>
                            
                                                <div class="form-floating mb-3">
                                                    <textarea name="observacoes" id="observacoes" class="form-control" style="height: 100px" placeholder="Observações">{{ $task->observacoes }}</textarea>
                                                    <label for="observacoes">Observações</label>
                                                </div>
                            
                                                <div class="mb-3">
                                                    <label class="form-label">Prioridade</label>
                            
                                                    <div class="form-check">
                                                        <input type="radio" name="prioridade" id="1doneEdit" class="form-check-input" value="1" {{ $task->prioridade == 1 ? 'checked' : '' }}>
                                                        <label for="1" class="form-check-label">1 (Maior prioridade)</label>
                                                    </div>
                            
                                                    <div class="form-check">
                                                        <input type="radio" name="prioridade" id="2doneEdit" class="form-check-input" value="2" {{ $task->prioridade == 2 ? 'checked' : '' }}>
                                                        <label for="2" class="form-check-label">2</label>
                                                    </div>
                            
                                                    <div class="form-check">
                                                        <input type="radio" name="prioridade" id="3doneEdit" class="form-check-input" value="3" {{ $task->prioridade == 3 ? 'checked' : '' }}>
                                                        <label for="3" class="form-check-label">3</label>
                                                    </div>
                            
                                                    <div class="form-check">
                                                        <input type="radio" name="prioridade" id="4doneEdit" class="form-check-input" value="4" {{ $task->prioridade == 4 ? 'checked' : '' }}>
                                                        <label for="4" class="form-check-label">4</label>
                                                    </div>
                            
                                                    <div class="form-check">
                                                        <input type="radio" name="prioridade" id="5doneEdit" class="form-check-input" value="5" {{ $task->prioridade == 5 ? 'checked' : '' }}>
                                                        <label for="5" class="form-check-label">5 (Menor prioridade)</label>
                                                    </div>
                                                </div>
                            
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="concluido" name="concluido" value="1" {{ $task->concluido == true ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="concluido">Marcar tarefa como já concluída</label>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Salvar alterações</button>
                                        </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                </div>
                
                @else
                    <div class="alert alert-info mt-3">
                        <span>
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mood-sing"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 9h.01" /><path d="M15 9h.01" /><path d="M15 15m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /></svg>
                        </span>
                        Não há nenhuma tarefa concluída no momento! Quando houver, elas serão mostradas aqui.
                    </div>
                @endif
            </div>

            {{-- Conteúdo da tab de tarefas excluídas --}}
            <div class="tab-pane fade" id="deleted-tab-pane" role="tabpanel" aria-labelledby="deleted-tab" tabindex="0">
                @if ($deletedTasks->isNotEmpty())
                <div class="row">
                    @foreach ($deletedTasks as $task)
                        <div class="card m-3" style="width: 30%;">
                            <div class="card-body">
                              <h5 class="card-title">{{ $task->titulo }} <span class="badge text-bg-{{ $task->prioridade <= 2 ? 'success' : ($task->prioridade <= 4 ? 'warning' : 'danger') }}">{{ $task->prioridade }}</span></h5>
                              
                              <h6 class="card-subtitle mb-2 text-body-secondary">
                                <span>
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                </span>
                                {{ date('d/m/Y, H:i', strtotime($task->deleted_at)) }}
                            </h6>
                              
                              <p class="card-text">{{ $task->observacoes }}</p>
                              
                              <div class="row">
                                <div class="col-md-6">
                                    <form action="/restaurar/{{ $task->id }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-warning me-2" type="submit" style="width: 100%">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-restore"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3.06 13a9 9 0 1 0 .49 -4.087" /><path d="M3 4.001v5h5" /><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                                        </button>
                                    </form>
                                </div>

                                <div class="col-md-6">
                                    
                                    <button class="btn btn-danger" type="submit" style="width: 100%" data-bs-toggle="modal" data-bs-target="#destroyModal">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7h16" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /><path d="M10 12l4 4m0 -4l-4 4" /></svg>
                                    </button>
                                </div>

                                <div class="modal fade" id="destroyModal" tabindex="-1" aria-labelledby="destroyModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Deletar permanentemente?</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Essa ação não pode ser desfeita.
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                          <form action="/destruir/{{ $task->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">
                                                Excluir
                                            </button>
                                        </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                </div>
                @else
                <div class="alert alert-info mt-3">
                    <span>
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mood-tongue-wink"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 21a9 9 0 1 1 0 -18a9 9 0 0 1 0 18z" /><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 10h.01" /><path d="M10 14v2a2 2 0 0 0 4 0v-2" /><path d="M15.5 14h-7" /><path d="M17 10c-.5 -1 -2.5 -1 -3 0" /></svg>
                    </span>
                    Não há nenhuma tarefa deletada no momento! Quando houver, elas serão mostradas aqui.
                </div>
                @endif
            </div>
        </div>
    </div>
    
</body>
</html>