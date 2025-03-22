<!-- weight_logs/create.blade.php -->


<link rel="stylesheet" href="{{ asset('css/create.css') }}">

<form class="form" id="weightLogForm" method="POST" action="{{ route('weight_logs.store') }}">
    @csrf
    <div class="form-title">
        <h2 class="form-title_h2">Weight Logを追加</h2>
    </div>


    <div class="form-date">
        <div class="form-date_label">
            <label class="form_label" for="date">日付<span class="required">必須</span></label>
        </div>
        <div class="form-date_input">
            <input class="form_input" type="date" name="date" id="date" value="2024-01-01">
            <span id="date-error" class="text-danger"></span>
        </div>
    </div>

    <div class="form-date_weight">
        <div class="form-date_label">
            <label class="form_label" for="weight">体重<span class="required">必須</span></label>
        </div>
        <div class="form-date_input">
            <input class="form_input-weight" type="number" name="weight" id="weight" step="0.1" placeholder="50.0"><span
                class="kg">kg</span>
            <span id="weight-error" class="text-danger"></span>
        </div>
    </div>

    <div class="form-date_calories">
        <div class="form-date_label">
            <label class="form_label" for="calories">カロリー<span class="required">必須</span></label>
        </div>
        <div class="form-date_input">
            <input class="form_input-calories" type="number" name="calories" id="calories" placeholder="1200"><span
                class="cal">cal</span>
            <span id="calories-error" class="text-danger"></span>
        </div>
    </div>

    <div class="form-date_exercise_time">
        <div class="form-date_label">
            <label class="form_label" for="exercise_time">運動時間<span class="required">必須</span></label>
        </div>
        <div class="form-date_input">
            <input class="form_input" type="number" name="exercise_time" id="exercise_time" placeholder="00:00">
            <span id="exercise_time-error" class="text-danger"></span>
        </div>
    </div>

    <div class="form-date_exercise_content">
        <div class="form-date_label">
            <label class="form_label" for="exercise_content">運動内容</label>
        </div>
        <div class="form-date_input">
            <textarea class="form_input-textarea" type="text" name="exercise_content" id="exercise_content"
                placeholder="運動内容を追加"></textarea>
            <span id="exercise_content-error" class="text-danger"></span>
        </div>
    </div>

    <div class="form-date_submit">
        <div class="form-date_btn">
            <button class="form_btn" type="button" id="return-btn">戻る</button>
        </div>
        <div class="form-date_btn">
            <button class="form_submit" type="submit" id="submitBtn">登録</button>
        </div>
    </div>
</form>