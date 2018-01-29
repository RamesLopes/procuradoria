<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-3">
                <h4>
                    <a href="{{ route('home.index') }}">Andamentos</a>

                </h4>
            </div>

            <div class="col-md-9">
                <a href="{{ route('andamentos.create') }}" class="btn btn-primary pull-right" onclick="f_editar()">
                    <i class="fa fa-plus"></i>
                    novo andamento
                </a>
            </div>
        </div>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>

                        <tr>
                            <th>Tipo de Andamento</th>
                            <th>Tipo de Entrada</th>
                            <th>Tipo de Prazo</th>
                            <th>Data Prazo</th>
                            <th>Observação</th>
                        </tr>
                    </thead>
                    @forelse ($andamentos as $andamento)
                        <tr>

                            <td><a href="{{ route('andamentos.show',['id' => $andamento->id]) }}">{{ $andamento->tipoAndamento->nome }}</a></td>
                            <td>{{ $andamento->tipoEntrada->nome }}</td>
                            <td>{{ $andamento->tipoPrazo->nome }}</td>
                            <td>{{ $andamento->data_prazo }}</td>
                            <td>{{ $andamento->observacoes }}</td>
                        </tr>
                    @empty
                        <p>Nenhum Andamento encontrado</p>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>
