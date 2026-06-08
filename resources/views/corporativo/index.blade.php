@extends('corporativo.layout')

@section('title', 'SERVIMETAL A&M S.A.C. - Soluciones en Metalmecánica')

@section('content')
<style>
    .hero {
        position: relative;
        min-height: 360px;
        background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
                    url('https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=1400') center/cover no-repeat;
        color: #fff;
        padding: 5rem 0;
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
        color: #0d6efd;
        font-weight: 700;
        margin-bottom: 2rem;
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
        color: #0d6efd;
        margin-bottom: .75rem;
    }
    .service-card-c h6 {
        color: #0d6efd;
        font-weight: 700;
        margin-bottom: .5rem;
    }
    .service-card-c p {
        font-size: .85rem;
        color: #6b7280;
        margin: 0;
    }

    .nosotros-img {
        max-height: 130px;
    }

    .contact-form-c .form-control {
        border-radius: 4px;
        font-size: .9rem;
    }
    .contact-form-c label {
        color: #0d6efd;
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
                    <i class="fas fa-hammer"></i>
                    <h6>Fabricación<br>Metalmecánica</h6>
                    <p>Diseño y fabricación de estructuras metálicas y componentes industriales.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="service-card-c">
                    <i class="fas fa-tools"></i>
                    <h6>Mantenimiento<br>Industrial</h6>
                    <p>Servicios de mantenimiento preventivo y correctivo para equipos e instalaciones.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="service-card-c">
                    <i class="fas fa-building"></i>
                    <h6>Montaje y<br>Construcción</h6>
                    <p>Montaje de estructuras metálicas y obras de construcción industrial.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="service-card-c">
                    <i class="fas fa-headset"></i>
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
                <h5 class="text-primary fw-bold mb-3">Nosotros</h5>
                <p class="small text-muted">
                    Somos una empresa especializada en soluciones integrales de metalmecánica, con un equipo de profesionales comprometidos con la calidad, la mejora continua y el servicio al cliente en cada proyecto.
                </p>
                <img src="https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=400"
                     class="img-fluid nosotros-img mt-2" alt="Nosotros">
            </div>

            <div class="col-lg-6">
                <h5 class="text-primary fw-bold mb-3">Contáctanos</h5>
                <form class="contact-form-c" action="#" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col-md-6 mb-2">
                            <label>Nombre completo</label>
                            <input type="text" class="form-control" placeholder="Nombre completo" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Correo electrónico</label>
                            <input type="email" class="form-control" placeholder="Correo electrónico" required>
                        </div>
                        <div class="col-12 mb-2">
                            <label>Asunto</label>
                            <input type="text" class="form-control" placeholder="Asunto" required>
                        </div>
                        <div class="col-12 mb-2">
                            <label>Mensaje</label>
                            <textarea class="form-control" rows="3" placeholder="Mensaje" required></textarea>
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
