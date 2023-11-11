<div>
    @if (!empty(auth()->user())) Пользователь {{ auth()->user()->email }} <br /> @endif
    @if (!empty($created)) Заметка с содержимым: <br /> @endif
    @if (!empty($created->title)) Название: {{ $created->title }}, <br /> @endif
    @if (!empty($created->description)) Описание: {{ $created->description }}, <br /> @endif
</div>