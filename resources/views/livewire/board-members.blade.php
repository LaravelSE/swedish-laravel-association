<div>
    <section class="section" id="board">
        <div class="section-header">
            <h2 class="section-title">Board Members</h2>
            <p class="section-subtitle">Meet the team behind Swedish Laravel Association.</p>
        </div>
        <div class="board-grid">
            @foreach($boardMembers as $member)
                <div class="board-card">
                    <div class="board-avatar"><img src="{{ asset($member['image']) }}" alt="{{ $member['name'] }}"></div>
                    <div class="board-name">{{ $member['name'] }}</div>
                    <div class="board-role">{{ $member['role'] }}</div>
                    <div class="board-company">{{ $member['company'] }}</div>
                </div>
            @endforeach
        </div>
    </section>
</div>
