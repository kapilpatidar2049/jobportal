<ul class="menu">
    <li class="menu-item">
        <a href="{{ route('jobportal.job_create') }}" class="menu-link" title="{{ __('Create New Job') }}">
            <i class="fa-solid fa-plus"></i> <span>{{ __('Create New Job') }}</span>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{route('jobportal.jobs')}}" class="menu-link" id="urls-toggle" title="{{ __('All Jobs') }}">
            <i class="fas fa-briefcase"></i> <span>{{ __('All Jobs') }}</span>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{route('chat')}}" class="menu-link" title="{{ __('Chat') }}">
            <i class="fa-solid fa-message"></i> <span>{{ __('Chat') }}</span>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{route('job.candidate')}}" class="menu-link" title="{{ __('Candidates') }}">
            <i class="fa-solid fa-users-viewfinder"></i> <span>{{ __('Candidates') }}</span>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{route('interview')}}" class="menu-link" title="{{ __('Interviews') }}">
            <i class="fa-regular fa-calendar"></i> <span>{{ __('Interviews') }}</span>
        </a>
    </li>
    <li class="menu-item">
        <a href="#" class="menu-link" title="{{ __('Help centre') }}">
            <i class="fa-solid fa-handshake-angle"></i> <span>{{ __('Help centre') }}</span>
        </a>
    </li>
</ul>
