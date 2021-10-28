@extends('visitor.layout.mainlayout')
@section('title', 'Careers')
@section('content')
    <section class="inner_header gestures">
        <div class="container">
            <h2>Become a Part of Our Big Family</h2>
            <p class="text-white">Join this team of remarkable people and make real change happen. Organizations and volunteers working together for peace and development. This is a movement of active citizens helping people and communities learn to live together.</p>
        </div>
    </section>


    <section class="career d-padding">
        <div class="container table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Apply</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($careers as $career)
                    <tr>
                        <td>{{ $career->position }}</td>
                        <td>{{ $career->location }}</td>
                        <td>{{ $career->type }}</td>
                        <td>
                            <div class="site-btn-2 btn-common">
                                <a href="{{route('register-page')}}" class="w-100 text-center">Apply Now</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    @include('visitor.inc.cta')
    @include('visitor.inc.gallery')
@endsection
