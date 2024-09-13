<?php
/*** set the content type header ***/
/*** Without this header, it won't work ***/
header("Content-type: text/css");
?>

/* Reset CSS */
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}

html, body {
  height: 100%; 
  margin: 0;
}

/* sessão login */
.login-section {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh; /* Garante que ocupe toda a altura da viewport */
}

.login-box {
  font-size: 10px;
  position: relative; /* Ajusta o posicionamento da caixa de login */
  width: 25rem;
  height: 20rem;
  border-width: 1px;
  border-radius: 8%;
  border-style: solid;
  border-color: #ccc;
  padding: 20px;
  background-color: white; /* Garante que o fundo da caixa de login seja branco e visível */

  /* Adicionando flexbox */
  display: flex;
  flex-direction: column; /* Organiza os itens em uma coluna */
  justify-content: center; /* Centraliza verticalmente */
  align-items: center; /* Centraliza horizontalmente */
  text-align: center; /* Centraliza o texto dentro dos itens */
}

.login-box input {
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  margin: 0 auto;
  width: 12rem;
  height: 2rem;
  margin-top: 8px;
  border: solid 1px #ccc;
  border-radius: 10px;
}

.login-box ::placeholder {
  text-align: center;
  font-size: 1rem;
}

.login-section .btn {
  border-color: #ccc;
  border-radius: 10px;
  margin-top: 8px;
  width: 9rem;
  height: 2.5rem;
  padding: 5px 10px;
  font-size: 9px;
  font-size: 1rem;
}

/* sessão cadastrar */

.cadastrar-section {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh; /* Garante que ocupe toda a altura da viewport */
}

.cadastrar-box {
  font-size: 10px;
  position: relative; /* Ajusta o posicionamento da caixa de login */
  width: 25rem;
  height: 20rem;
  border-width: 1px;
  border-radius: 8%;
  border-style: solid;
  border-color: #ccc;
  padding: 20px;
  background-color: white; /* Garante que o fundo da caixa de login seja branco e visível */

  /* Adicionando flexbox */
  display: flex;
  flex-direction: column; /* Organiza os itens em uma coluna */
  justify-content: center; /* Centraliza verticalmente */
  align-items: center; /* Centraliza horizontalmente */
  text-align: center; /* Centraliza o texto dentro dos itens */
}

.cadastrar-box input {
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  margin: 0 auto;
  width: 12rem;
  height: 2rem;
  margin-top: 8px;
  border: solid 1px #ccc;
  border-radius: 10px;
}

.cadastrar-box ::placeholder {
  text-align: center;
  font-size: 1rem;
}

.cadastrar-section .btn {
  border-color: #ccc;
  border-radius: 10px;
  margin-top: 8px;
  width: 9rem;
  height: 2.5rem;
  padding: 5px 10px;
  font-size: 9px;
  font-size: 1rem;
}