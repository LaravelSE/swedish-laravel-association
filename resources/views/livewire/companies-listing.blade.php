<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: var(--spacing-12);">
        <div class="section-header">
            <h2 class="section-title">Companies Using Laravel</h2>
            <p class="section-subtitle">Discover companies building with Laravel across Sweden.</p>
        </div>

        <div class="companies-card">
            <div class="filter-bar">
                <label for="cityFilter">Filter by city</label>
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
                <p>Know a company using Laravel? <a href="{{ route('submit-company') }}">Submit it</a></p>
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

        .companies-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius-2xl);
            padding: var(--spacing-8);
            max-width: 900px;
            margin: 0 auto;
        }

        .filter-bar {
            display: flex;
            align-items: center;
            gap: var(--spacing-3);
            margin-bottom: var(--spacing-6);
        }

        .filter-bar label {
            font-weight: 600;
            font-size: 0.8125rem;
            white-space: nowrap;
            color: var(--gray-700);
        }

        .filter-select {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            font-family: inherit;
            border: 1px solid var(--gray-300);
            border-radius: var(--border-radius-lg);
            background-color: white;
            color: var(--gray-700);
            appearance: auto;
            transition: border-color var(--transition-fast);
        }

        .filter-select:focus {
            border-color: var(--gray-900);
            outline: 0;
            box-shadow: 0 0 0 3px rgba(24, 24, 27, 0.08);
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
            border-bottom: 1px solid var(--gray-100);
        }

        .companies-table th {
            font-weight: 600;
            color: var(--gray-500);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding-bottom: 0.875rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .companies-table tbody tr {
            transition: background var(--transition-fast);
        }

        .companies-table tbody tr:hover {
            background-color: var(--gray-50);
        }

        .company-name {
            font-weight: 600;
            color: var(--gray-900);
        }

        .companies-table td {
            color: var(--gray-600);
            font-size: 0.9375rem;
        }

        .companies-table a {
            color: var(--gray-900);
            text-decoration: none;
            font-weight: 500;
        }

        .companies-table a:hover {
            text-decoration: underline;
        }

        .empty-state {
            text-align: center;
            padding: var(--spacing-12) var(--spacing-4);
            color: var(--gray-500);
        }

        .cta-bar {
            text-align: center;
            margin-top: var(--spacing-6);
            padding-top: var(--spacing-6);
            border-top: 1px solid var(--gray-100);
            color: var(--gray-500);
            font-size: 0.9375rem;
        }

        .cta-bar a {
            color: var(--gray-900);
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

            .companies-card {
                padding: var(--spacing-5);
            }
        }
    </style>
</div>
