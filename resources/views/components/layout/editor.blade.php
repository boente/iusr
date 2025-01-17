<div class="editor">
    @foreach ($getComponents(withHidden: true) as $formComponent)
        {{ $formComponent }}
    @endforeach
</div>
