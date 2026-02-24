<div>
    <section class="section" id="board">
        <div class="section-header">
            <div class="section-cmd">$ board --list --format=table</div>
            <h2 class="section-title">Board Members</h2>
            <p class="section-subtitle">Meet the team behind Swedish Laravel Association.</p>
        </div>
        <div class="board-grid">
            @foreach($boardMembers as $member)
                <div class="board-card" wire:key="board-{{ $member->id }}">
                    <div class="board-avatar">
                        <img src="{{ $member->imageUrl() }}" alt="{{ $member->name }}" width="80" height="80" loading="lazy">
                    </div>
                    <div class="board-info">
                        <div class="board-name">{{ $member->name }}</div>
                        <div class="board-role">{{ $member->role }}</div>
                        <div class="board-company">// {{ $member->company }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    
</div>
