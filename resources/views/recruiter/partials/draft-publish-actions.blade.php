@php
    $draftButtonLabel = $draftButtonLabel ?? 'Save Draft';
    $publishButtonLabel = $publishButtonLabel ?? 'Publish Job';
@endphp

<input type="hidden" name="is_draft" id="isDraftInput" value="0">

<div class="actions-row draft-publish-actions">
    <button type="submit" class="btn-ghost" id="saveDraftButton" value="draft" name="action">
        {{ $draftButtonLabel }}
    </button>
    <button type="submit" class="btn-primary" id="publishButton" value="publish" name="action">
        {{ $publishButtonLabel }}
    </button>
</div>
