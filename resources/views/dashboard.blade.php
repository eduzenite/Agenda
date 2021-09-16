<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="my-4">
            <div class="row">
                <div class="col-md-6">
                    <form method="get" action="{{ route('dashboard') }}" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="q" placeholder="Pesquisar contato" aria-label="Pesquisar contato" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Pesquisar</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa fa-user"></i> Novo Contato
                    </button>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('contact.create') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Criar Novo Contato</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Name -->
                                <div class="form-group mb-3">
                                    <x-label for="name" class="required" :value="__('Full Name')"/>
                                    <x-input id="name" type="text" name="name" :value="old('name')" :placeholder="__('Full Name')" required autofocus/>
                                    @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Email Address -->
                                <div class="form-group mb-3">
                                    <x-label for="email" class="required" :value="__('Email')"/>
                                    <x-input id="email" type="email" name="email" :value="old('email')" :placeholder="__('Email')" required/>
                                    @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <x-label for="phone" class="required" :value="__('Phone')"/>
                                    <x-input id="phone" class="phone" type="text" name="phone" :value="old('phone')" placeholder="(11) 99999-9999" required/>
                                    @error('phone')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Criar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if($contacts->contacts->last_page > 0)
            <div class="row">
                @foreach($contacts->contacts->data as $contact)
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $contact->name }}</h5>
                                <p class="card-text"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                                <a href="tel:{{ $contact->email }}" class="btn btn-primary">Ligar</a>
                                <a href="https://api.whatsapp.com/send?phone=55{{ preg_replace('/[^0-9]/', '', $contact->phone) }}" target="_blank" class="btn btn-success">WhatsApp</a>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editModal{{ $contact->id }}">
                                    Editar Contato
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $contact->id }}">
                                    Deletar Contato
                                </button>
                            </div>
                        </div>
                        <div class="modal fade" id="deleteModal{{ $contact->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('contact.delete', ['id' => $contact->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar Contato</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger">Tem certeza que deseja deletar esse usuário?</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger">Deletar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="editModal{{ $contact->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('contact.update', ['id' => $contact->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar Contato</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Name -->
                                            <div class="form-group mb-3">
                                                <x-label for="name" class="required" :value="__('Full Name')"/>
                                                <x-input id="name" type="text" name="name" :value="$contact->name" :placeholder="__('Full Name')" required autofocus/>
                                            </div>

                                            <!-- Email Address -->
                                            <div class="form-group mb-3">
                                                <x-label for="email" class="required" :value="__('Email')"/>
                                                <x-input id="email" type="email" name="email" :value="$contact->email" :placeholder="__('Email')" required/>
                                            </div>

                                            <div class="form-group mb-3">
                                                <x-label for="phone" class="required" :value="__('Phone')"/>
                                                <x-input id="phone" class="phone" type="text" name="phone" :value="$contact->phone" placeholder="(11) 99999-9999" required/>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning">Nenhum resultado encontrado</div>
        @endif

        @if($contacts->contacts->last_page > 1)
            <hr>
            <nav aria-label="Paginação">
                <ul class="pagination justify-content-center">
                    @foreach($contacts->contacts->links as $page)
                        <li class="page-item {{ $page->active ? 'active' : '' }}">
                            @if(!empty($page->url))
                                <a class="page-link" href="?page={{ $page->label }}">{!! $page->label !!}</a>
                            @else
                                <a class="page-link" href="#">{!! $page->label !!}</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
        @endif

    </div>
</x-app-layout>
