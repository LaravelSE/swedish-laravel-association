<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: 2rem;">
        <div class="section-header">
            <h2 class="section-title">Companies Using Laravel in Sweden</h2>
            <p class="section-subtitle">Discover companies building with Laravel across Sweden.</p>
        </div>

        <div class="card" style="max-width: 900px; margin: 0 auto;">
            <div class="filter-bar">
                <label for="cityFilter">Filter by city:</label>
                <select id="cityFilter" wire:model.live="cityFilter" class="filter-select">
                    <option value="">All cities</option>
                    @foreach($cities as $city)
                        <option value="{{ $city }}">{{ $city }}</option>
                    @endforeach
                </select>
            </div>

            @if($companies->isEmpty())
                <div class="empty-state">
                    <p>No companies found{{ $cityFilter ? ' in '.$cityFilter : '' }}.</p>
                </div>
            @else
                <div class="companies-table-wrapper">
                    <table class="companies-table">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>City</th>
                                <th>Industry</th>
                                <th>Website</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                                <tr wire:key="company-{{ $company->id }}">
                                    <td class="company-name">{{ $company->name }}</td>
                                    <td>{{ $company->city }}</td>
                                    <td>{{ $company->industry ?? '—' }}</td>
                                    <td>
                                        @if($company->website)
                                            <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer">{{ parse_url($company->website, PHP_URL_HOST) }}</a>
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="cta-bar">
                <p>Know a company using Laravel? <a href="{{ route('submit-company') }}">Submit it!</a></p>
            </div>
        </div>
    </section>

    @livewire('footer')

    <style>
        .page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
        }

        .filter-bar {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .filter-bar label {
            font-weight: 500;
            white-space: nowrap;
            margin-bottom: 0;
        }

        .filter-select {
            padding: 0.5rem 0.75rem;
            font-size: 1rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            background-color: #fff;
            appearance: auto;
        }

        .filter-select:focus {
            border-color: #FF2D20;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(255, 45, 32, 0.25);
        }

        .companies-table-wrapper {
            overflow-x: auto;
        }

        .companies-table {
            width: 100%;
            border-collapse: collapse;
        }

        .companies-table th,
        .companies-table td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--gray-200);
        }

        .companies-table th {
            font-weight: 600;
            color: var(--gray-700);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .companies-table tbody tr:hover {
            background-color: var(--gray-50, #f9fafb);
        }

        .company-name {
            font-weight: 600;
            color: var(--gray-900);
        }

        .companies-table a {
            color: #FF2D20;
            text-decoration: none;
        }

        .companies-table a:hover {
            text-decoration: underline;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--gray-600);
        }

        .cta-bar {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }

        .cta-bar a {
            color: #FF2D20;
            font-weight: 600;
            text-decoration: none;
        }

        .cta-bar a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .companies-table th:nth-child(3),
            .companies-table td:nth-child(3) {
                display: none;
            }
        }
    </style>
</div>
