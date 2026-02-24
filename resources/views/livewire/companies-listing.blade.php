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

    
</div>
