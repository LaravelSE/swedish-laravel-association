<div class="page-container">
    @livewire('header')

    <section class="cl-section main-content">
        <div class="cl-page-header">
            <p class="cl-command">$ companies --filter=approved --sort=name</p>
            <p class="cl-subtitle">Discover companies building with Laravel across Sweden.</p>
        </div>

        <div class="cl-card">
            <div class="cl-filter-bar">
                <span class="cl-filter-label">// filter</span>
                <select id="cityFilter" wire:model.live="cityFilter" class="cl-select">
                    <option value="">--city=all</option>
                    @foreach($cities as $city)
                        <option value="{{ $city }}">--city={{ $city }}</option>
                    @endforeach
                </select>
            </div>

            @if($companies->isEmpty())
                <div class="cl-empty-state">
                    <p>// no results found &mdash; try adjusting your filters</p>
                </div>
            @else
                <div class="cl-table-wrap">
                    <table class="cl-table">
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
                                    <td class="cl-company-name">
                                        <span class="cl-org-badge">[ORG]</span>
                                        {{ $company->name }}
                                    </td>
                                    <td>{{ $company->city }}</td>
                                    <td>{{ $company->industry ?? '—' }}</td>
                                    <td>
                                        @if($company->website)
                                            <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer" class="cl-link">{{ parse_url($company->website, PHP_URL_HOST) }}</a>
                                        @else
                                            <span class="cl-dash">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $companies->links() }}
            @endif

            <div class="cl-cta-bar">
                <p>Know a company using Laravel? <a href="{{ route('submit-company') }}" class="cl-cta-link">Submit it</a></p>
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
            max-width: var(--max-w, 1120px);
            margin: 0 auto;
            padding: 3rem var(--px, 2rem) 5rem;
            width: 100%;
        }

        .cl-page-header {
            margin-bottom: 2rem;
        }

        .cl-command {
            font-family: var(--font-mono, 'Fira Code', 'Cascadia Code', monospace);
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--tm-yellow);
            letter-spacing: -0.01em;
            margin-bottom: 0.5rem;
        }

        .cl-subtitle {
            font-size: 0.875rem;
            color: var(--tm-muted);
        }

        .cl-card {
            background: var(--tm-surface);
            border: 1px solid var(--tm-border);
            border-radius: 0.5rem;
            padding: 2rem;
            max-width: 860px;
        }

        .cl-filter-bar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .cl-filter-label {
            font-family: var(--font-mono, 'Fira Code', 'Cascadia Code', monospace);
            font-size: 0.8125rem;
            color: var(--tm-muted);
            white-space: nowrap;
        }

        .cl-select {
            padding: 0.4375rem 0.75rem;
            font-size: 0.8125rem;
            font-family: var(--font-mono, 'Fira Code', 'Cascadia Code', monospace);
            background: var(--tm-bg);
            color: var(--tm-text);
            border: 1px solid var(--tm-border);
            border-radius: 0.25rem;
            appearance: auto;
            transition: border-color 0.15s, box-shadow 0.15s;
            cursor: pointer;
        }

        .cl-select:focus {
            outline: none;
            border-color: var(--tm-yellow);
            box-shadow: 0 0 0 3px rgba(230, 192, 82, 0.15);
        }

        .cl-table-wrap {
            overflow-x: auto;
        }

        .cl-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cl-table th {
            padding: 0.625rem 0.75rem 0.75rem;
            text-align: left;
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--tm-muted);
            border-bottom: 1px solid var(--tm-border);
        }

        .cl-table td {
            padding: 0.75rem;
            font-size: 0.875rem;
            color: var(--tm-muted);
            border-bottom: 1px solid var(--tm-border);
        }

        .cl-table tbody tr {
            transition: background 0.15s;
        }

        .cl-table tbody tr:hover {
            background: rgba(230, 192, 82, 0.04);
        }

        .cl-table tbody tr:hover .cl-company-name {
            color: var(--tm-yellow);
        }

        .cl-table tbody tr:last-child td {
            border-bottom: none;
        }

        .cl-company-name {
            color: var(--tm-text);
            font-weight: 600;
            transition: color 0.15s;
            white-space: nowrap;
        }

        .cl-org-badge {
            display: inline-block;
            font-family: var(--font-mono, 'Fira Code', 'Cascadia Code', monospace);
            font-size: 0.6875rem;
            font-weight: 700;
            color: var(--tm-yellow);
            margin-right: 0.5rem;
            letter-spacing: 0.02em;
        }

        .cl-link {
            color: var(--tm-blue);
            text-decoration: none;
            transition: color 0.15s;
        }

        .cl-link:hover {
            color: var(--tm-yellow);
            text-decoration: underline;
        }

        .cl-dash {
            color: var(--tm-muted);
            opacity: 0.5;
        }

        .cl-empty-state {
            padding: 3rem 1rem;
            text-align: center;
        }

        .cl-empty-state p {
            font-family: var(--font-mono, 'Fira Code', 'Cascadia Code', monospace);
            font-size: 0.875rem;
            color: var(--tm-muted);
        }

        .cl-cta-bar {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--tm-border);
            text-align: center;
        }

        .cl-cta-bar p {
            font-size: 0.875rem;
            color: var(--tm-muted);
        }

        .cl-cta-link {
            color: var(--tm-yellow);
            font-weight: 600;
            text-decoration: none;
            transition: opacity 0.15s;
        }

        .cl-cta-link:hover {
            opacity: 0.8;
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .cl-table th:nth-child(3),
            .cl-table td:nth-child(3) {
                display: none;
            }

            .cl-card {
                padding: 1.25rem;
            }

            .cl-command {
                font-size: 0.9375rem;
            }
        }

        @media (max-width: 375px) {
            .cl-table th:nth-child(4),
            .cl-table td:nth-child(4) {
                display: none;
            }
        }
    </style>
</div>
