<!-- doing attribute merge - shouldn't hardcode href link -->
<a {{ $attributes->merge(['class' => 'card bg-neutral-700 text-white w-96']) }}>
                <div class="card-body">
                    <h2 class="card-title">{{ $slot }}</h2>
                </div>
            </a>
