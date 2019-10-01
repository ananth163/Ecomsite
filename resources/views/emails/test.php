<style type="text/css">
.header {
  background: #8a8a8a;
}
.header .columns {
  padding-bottom: 0;
}
.header p {
  color: #fff;
  margin-bottom: 0;
}
.header .wrapper-inner {
  padding: 20px; /*controls the height of the header*/
}
.header .container {
  background: #8a8a8a;
}
.wrapper.secondary {
  background: #f3f3f3;
}
</style>
<!-- move the above styles into your custom stylesheet -->


<wrapper class="header" bgcolor="#8a8a8a">
  <container>
    <row class="collapse">
      <columns small="6" valign="middle">
        <img src="http://placehold.it/200x50/663399">
      </columns>
      <columns small="6" valign="middle">
        <p class="text-right">BASIC</p>
      </columns>
    </row>
  </container>
</wrapper>

<container>

  <spacer size="16"></spacer>
  
  <row>
    <columns>
      
      <h1>Hi, Susan Calvin</h1>
      <p><?= $body; ?></p>


    </columns>
  </row>
  


</container>

