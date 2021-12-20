<div id="loader" class="fade show">
  <div class="loader">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
    <div class="shape shape-4"></div>
  </div>
  <p>Загрузка...</p>
</div>

<style wb-module="scss">
  // Colors variables
  $primary: #4285F4; // blue
  $success: #34A853; // green
  $danger: #EA4335; // red
  $warning: #FBBC05; // yellow
  // Container and shapes dimentions
  $containerDimentions: 30px;
  $shapeDimentions: 12px;
  //shape translate amount
  $amount: 18px;

  // custom translation for each shape in an animation
  @mixin customTranslate ($shape, $tx, $ty) {
    @if $shape==1 {
      transform: translate($tx, $ty);
    }

    @else if $shape==2 {
      transform: translate(-$ty, $tx);
    }

    @else if $shape==3 {
      transform: translate($ty, -$tx);
    }

    @else if $shape==4 {
      transform: translate(-$tx, -$ty);
    }
  }

  body {
    position: relative;
    &.load {
      position: absolute;
      margin: 0;
      padding: 0;
      width: 100vw !important;
      height: 100vh !important;
      overflow: hidden !important;
    }
    #loader {
      position: absolute;
      top: 0;
      left: 0;
      width: 100vw !important;
      height: 100vh !important;
      overflow: hidden !important;
      background-color: #c9ffc7;
      display: flex;
      justify-content: center;
      align-items: center;
      box-sizing: border-box;
      z-index: 1000;

      p {
        position: absolute;
        padding-top: 100px;
        font-family: sans-serif;
        font-size: 24px;
        color: #34A853;
      }

      .loader {
        position: relative;
        width: $containerDimentions;
        height: $containerDimentions;
        animation: rotation 1s infinite;

        .shape {
          position: absolute;
          width: $shapeDimentions;
          height: $shapeDimentions;
          border-radius: 2px;

          &.shape-1 {
            left: 0;
            background-color: $primary;
          }

          &.shape-2 {
            right: 0;
            background-color: $success;
          }

          &.shape-3 {
            bottom: 0;
            background-color: $warning;
          }

          &.shape-4 {
            bottom: 0;
            right: 0;
            background-color: $danger;
          }
        }

        @for $i from 1 through 4 {
          .shape-#{$i} {
            animation: shape#{$i} 2s linear infinite;
          }
        }
      }
    }

  }



  @keyframes rotation {
    from {
      transform: rotate(0deg)
    }

    to {
      transform: rotate(360deg)
    }
  }

  @for $i from 1 through 4 {
    @keyframes shape#{$i} {
      0% {
        transform: translate(0, 0)
      }

      25% {
        @include customTranslate($i, 0, $amount)
      }

      50% {
        @include customTranslate($i, $amount, $amount)
      }

      75% {
        @include customTranslate($i, $amount, 0)
      }
    }
  }
</style>
<script>
  setTimeout(() => {
    document.body.classList.add("load");
  }, 5)
</script>