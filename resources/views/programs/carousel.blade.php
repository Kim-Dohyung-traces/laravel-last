<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <!-- <img class="carousel-img" src="files\programs\{{\App\Program_attachment::whereId(\App\Program::max('id'))->first()->filename}}" alt="1"> -->
      <img class="carousel-img" src="http://btrya23.iptime.org:8000/files/programs/{{\App\Program_attachment::whereId(\App\Program::max('id'))->first()->filename}}" alt="1">
      <div class="carousel-caption">
        <h1 class="carousel-title">{{App\Program::whereId(\App\Program::max('id'))->first()->title}}</h1>
      </div>
    </div>
    <div class="carousel-item">
      <!-- <img class="carousel-img" src="files\programs\{{\App\Program_attachment::whereId(\App\Program::whereNotIn('id',[\App\Program::max('id')])->max('id'))->first()->filename}}" alt="2"> -->
      <img class="carousel-img" src="http://btrya23.iptime.org:8000/files/programs/{{\App\Program_attachment::whereId(\App\Program::whereNotIn('id',[\App\Program::max('id')])->max('id'))->first()->filename}}" alt="2">
      <div class="carousel-caption">
        <h1 class="carousel-title">{{App\Program::whereId(\App\Program::whereNotIn('id',[\App\Program::max('id')])->max('id'))->first()->title}}</h1>
      </div>
    </div>
    <div class="carousel-item ">
      <!-- <img class="carousel-img" src="files\programs\{{\App\Program_attachment::whereId(\App\Program::whereNotIn('id',[\App\Program::max('id'),\App\Program::whereNotIn('id',[\App\Program::max('id')])->max('id')])->max('id'))->first()->filename}}" alt="3"> -->
      <img class="carousel-img" src="http://btrya23.iptime.org:8000/files/programs/{{\App\Program_attachment::whereId(\App\Program::whereNotIn('id',[\App\Program::max('id'),\App\Program::whereNotIn('id',[\App\Program::max('id')])->max('id')])->max('id'))->first()->filename}}" alt="3">
      <div class="carousel-caption">
        <h1 class="carousel-title">{{App\Program::whereId(\App\Program::whereNotIn('id',[\App\Program::max('id'),\App\Program::whereNotIn('id',[\App\Program::max('id')])->max('id')])->max('id'))->first()->title}}</h1>
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>