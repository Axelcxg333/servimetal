@extends('corporativo.layout')

@section('title', 'SERVIMETAL A&M S.A.C. - Soluciones en Metalmecánica')

@section('content')
<style>
    .hero {
        position: relative;
        min-height: 360px;
        background: linear-gradient(rgba(0, 0, 0, 0.100), rgba(0,0,0,0.100)),
                    url('../images/hero-background.jpg') center/cover no-repeat;
        color: #fff;
        padding: 5rem 0;
        text-align: left;
    }
    .hero h1 {
        font-size: 2.4rem;
        font-weight: 800;
        line-height: 1.2;
        max-width: 520px;
    }
    .hero p {
        font-size: 1rem;
        margin: 1rem 0 1.5rem;
        max-width: 460px;
    }

    .section-title-c {
        text-align: center;
        color: #012555;
        font-weight: 700;
        margin-bottom: 2rem;
    }

    .title-c {
        color: #012555;
        font-weight: 700;
    }

    .service-card-c {
        text-align: center;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 1.6rem 1rem;
        height: 100%;
        transition: transform .2s, box-shadow .2s;
    }
    .service-card-c:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }
    .service-card-c i {
        font-size: 1.6rem;
        color: #012555;
        margin-bottom: .75rem;
    }
    .service-card-c h6 {
        color: #012555;
        font-weight: 700;
        margin-bottom: .5rem;
    }
    .service-card-c p {
        font-size: .85rem;
        color: #6b7280;
        margin: 0;
    }
    .service-icon {
        width: 48px;
        height: 48px;
        object-fit: contain;
        margin-bottom: 15px;
    }

    .nosotros-img {
        max-height: 130px;
    }

    .contact-form-c .form-control {
        border-radius: 4px;
        font-size: .9rem;
    }
    .contact-form-c label {
        color: #012555;
        font-weight: 600;
        font-size: .85rem;
        margin-bottom: .25rem;
    }
</style>

<!-- Hero -->
<section class="hero">
    <div class="container">
        <h1>Soluciones Integrales<br>en Metalmecánica</h1>
        <p>Diseño, fabricación y mantenimiento con calidad y compromiso.</p>
        <a href="{{ route('corporativo.nosotros') }}" class="btn btn-primary px-4">Conócenos más</a>
    </div>
</section>

<!-- Servicios -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title-c">Nuestros Servicios</h2>
        <div class="row g-3">
            <div class="col-md-6 col-lg-3">
                <div class="service-card-c">
                    <img src="{{ asset('assets/icons/fabricacion.svg') }}" alt="Fabricación Metalmecánica" class="service-icon">
                    <h6>Fabricación<br>Metalmecánica</h6>
                    <p>Diseño y fabricación de estructuras metálicas y componentes industriales.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="service-card-c">
                    <img src="{{ asset('assets/icons/mantenimiento.svg') }}" alt="Icono Mantenimiento" class="service-icon">
                    <h6>Mantenimiento<br>Industrial</h6>
                    <p>Servicios de mantenimiento preventivo y correctivo para equipos e instalaciones.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="service-card-c">
                    <img src="{{ asset('assets/icons/montaje.svg') }}" alt="Icono Montaje" class="service-icon">
                    <h6>Montaje y<br>Construcción</h6>
                    <p>Montaje de estructuras metálicas y obras de construcción industrial.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="service-card-c">
                    <img src="{{ asset('assets/icons/asesoria.svg') }}" alt="Icono Asesoría" class="service-icon">
                    <h6>Asesoría y<br>Consultoría</h6>
                    <p>Asesoría técnica y gestión de proyectos industriales de diferentes magnitudes.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nosotros + Contacto -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <h5 class="title-c mb-3">Nosotros</h5>
                <div class="d-flex align-items-center mb-3">
                    <p class="small text-muted">
                        Somos una empresa especializada en soluciones integrales de metalmecánica, con un equipo de profesionales comprometidos con la calidad, la mejora continua y el servicio al cliente en cada proyecto.
                    </p>
                    <img src="{{ asset('assets/icons/nosotros.svg') }}" alt="Icono Nosotros" class="">
                </div>
            </div>

            <div class="col-lg-6">
                <h5 class="title-c mb-3">Contáctanos</h5>
                <form class="contact-form-c" action="#" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col-md-6 mb-2">
                            <input type="text" class="form-control" placeholder="Nombre completo" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <input type="email" class="form-control" placeholder="Correo electrónico" required>
                        </div>
                        <div class="col-12 mb-2">
                            <input type="text" class="form-control" placeholder="Asunto" required>
                        </div>
                        <div class="col-12 mb-2">

                            <textarea class="form-control" rows="4" placeholder="Mensaje" required></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary px-4">Enviar mensaje</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
