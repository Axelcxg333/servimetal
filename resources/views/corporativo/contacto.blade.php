@extends('corporativo.layout')

@section('title', 'Contacto - SERVIMETAL')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('corporativo.inicio') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Contacto</li>
        </ol>
    </div>
</nav>

<section>
    <div class="container">
        <div class="section-title">
            <h2>Contáctenos</h2>
            <p>Estamos listos para escuchar tus consultas y ayudarte en tus proyectos</p>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="contact-info">
                    <i class="fas fa-phone"></i>
                    <div>
                        <h6>Teléfono</h6>
                        <p>+51 1 2345678<br>+51 987 654321</p>
                    </div>
                </div>

                <div class="contact-info">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <h6>Correo Electrónico</h6>
                        <p>info@servimetal.com<br>ventas@servimetal.com</p>
                    </div>
                </div>

                <div class="contact-info">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <h6>Ubicación</h6>
                        <p>Av. Industrial 1234<br>Lima, Perú 15014</p>
                    </div>
                </div>

                <div class="contact-info">
                    <i class="fas fa-clock"></i>
                    <div>
                        <h6>Horario de Atención</h6>
                        <p>Lunes a Viernes: 8:00 AM - 6:00 PM<br>Sábado: 9:00 AM - 1:00 PM</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Envíanos tu mensaje</h5>
                        <form action="{{ route('corporativo.contacto') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre Completo *</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="empresa" class="form-label">Empresa</label>
                                    <input type="text" class="form-control" id="empresa" name="empresa">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="correo" class="form-label">Correo Electrónico *</label>
                                    <input type="email" class="form-control" id="correo" name="correo" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="asunto" class="form-label">Asunto *</label>
                                <input type="text" class="form-control" id="asunto" name="asunto" required>
                            </div>

                            <div class="mb-3">
                                <label for="mensaje" class="form-label">Mensaje *</label>
                                <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-paper-plane"></i> Enviar Mensaje
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
