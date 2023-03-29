<script type="text/javascript">
window.print();
</script>
<div>
  <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
  <div>
    <div class="frame231325-frame231325">
      <div class="frame231325-group81674">
        <div class="frame231325-group81673">
          <div class="frame231325-group81672">
            <span class="frame231325-text">
              <span>
                <span>
                  В твоей школе заработал проект по оценке питания в столовой
                </span>
                <br />
                <span></span>
              </span>
            </span>
            <img
              alt="Rectangle9272050"
              src="/playground_assets/rectangle9272050-2x9.svg"
              class="frame231325-rectangle927"
            />
            <span class="frame231325-text05">
              <span>
                <span>Ты можешь</span>
                <br />
                <span>помочь сделать</span>
                <br />
                <span>свой обед лучше</span>
              </span>
            </span>
          </div>
          <img
            alt="Rectangle9282056"
            src="/playground_assets/rectangle9282056-eak4.svg"
            class="frame231325-rectangle928"
          />
        </div>
        <img
          alt="Rectangle9292056"
          src="/playground_assets/rectangle9292056-5k09-200h.png"
          class="frame231325-rectangle929"
        />
        <span class="frame231325-text12">
          <span>Для того, чтобы принять участие:</span>
        </span>
      </div>
      <img
        alt="Vector2060"
        src="/playground_assets/vector2060-gzpe.svg"
        class="frame231325-vector"
      />
      <img
        alt="Vector2060"
        src="/playground_assets/vector2060-x4be.svg"
        class="frame231325-vector1"
      />
      <img
        alt="Vector2060"
        src="/playground_assets/vector2060-sc3a.svg"
        class="frame231325-vector2"
      />
      <img
        alt="Vector2060"
        src="/playground_assets/vector2060-rif1.svg"
        class="frame231325-vector3"
      />
      <span class="frame231325-text14"><span>Добавь фото и отзыв</span></span>
      <span class="frame231325-text16"><span>Поставь оценку</span></span>
      <span class="frame231325-text18"><span>Открой в браузере</span></span>
      <span class="frame231325-text20">
        <span class="frame231325-text21">Сканируй</span>
        <span>QR-код</span>
      </span>
      <img
        alt="Ellipse3852056"
        src="/playground_assets/ellipse3852056-wozr-200h.png"
        class="frame231325-ellipse385"
      />
      <img
        alt="Ellipse3882056"
        src="/playground_assets/ellipse3882056-pewl-200h.png"
        class="frame231325-ellipse388"
      />
      <img
        alt="Ellipse3872056"
        src="/playground_assets/ellipse3872056-1l2b-200h.png"
        class="frame231325-ellipse387"
      />
      <img
        alt="Ellipse3862056"
        src="/playground_assets/ellipse3862056-mo4s-200h.png"
        class="frame231325-ellipse386"
      />
      <span class="frame231325-text23"><span>Ты молодец, спасибо!</span></span>
      
      <div class="frame231325-rectangle930">
      {!! QrCode::encoding('UTF-8')->size(200)->generate("Оценить питание в $school->title $domain"); !!}
      </div>

      <img
        alt="downloadiphonehandpngfreeiphonehandpngPhotoRoom12062"
        src="/playground_assets/downloadiphonehandpngfreeiphonehandpngphotoroom12062-en76-500w.png"
        class="frame231325-downloadiphonehandpngfreeiphonehandpng-photo-room1"
      />
    </div>
  </div>
</div>