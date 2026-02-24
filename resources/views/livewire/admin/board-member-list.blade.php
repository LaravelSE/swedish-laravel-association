<div class="admin-page">
    <x-admin-nav />

    <div class="admin-body">
        <div class="admin-page-header">
            <h1 class="admin-page-title">Board Members</h1>
            <p class="admin-page-desc">Manage the board members displayed on the site.</p>
        </div>

        @if(session('message'))
            <div class="flash-message flash-success">
                {{ session('message') }}
            </div>
        @endif

        @if(session('error'))
            <div class="flash-message flash-error">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="toolbar">
                <a href="{{ route('admin.board-members.create') }}" class="btn-create">+ New Member</a>
            </div>

            @if($boardMembers->isEmpty())
                <div class="empty-state">
                    <p>No board members yet.</p>
                </div>
            @else
                <div class="members-table-wrapper">
                    <table class="members-table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Company</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($boardMembers as $member)
                                <tr wire:key="member-{{ $member->id }}">
                                    <td class="order-cell">{{ $member->sort_order }}</td>
                                    <td class="photo-cell">
                                        @if($member->imageUrl())
                                            <img src="{{ $member->imageUrl() }}" alt="{{ $member->name }}" width="40" height="40" class="member-thumb">
                                        @else
                                            <div class="member-thumb-placeholder"></div>
                                        @endif
                                    </td>
                                    <td class="member-name">{{ $member->name }}</td>
                                    <td>{{ $member->role }}</td>
                                    <td>{{ $member->company }}</td>
                                    <td class="action-cell">
                                        <a href="{{ route('admin.board-members.edit', $member) }}" class="review-link">Edit</a>
                                        <button wire:click="delete({{ $member->id }})"
                                            wire:confirm="Remove {{ $member->name }} from the board?"
                                            wire:loading.attr="disabled"
                                            wire:target="delete({{ $member->id }})"
                                            class="delete-btn">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    
</div>
