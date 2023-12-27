
<style>
	@charset "UTF-8";
	@import url(https://fonts.googleapis.com/css?family=Lato:700);
	.titlePack{
		font-size: 24px;
		font-weight: bold;
	}

	.wrapper-card {
		display: flex;
		flex-wrap: nowrap;
		margin: 40px auto;
		width: 77%;
	}

	.card {
		background: #fff;
		border-radius: 3px;
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0);
		flex: 1;
		margin: 8px;
		padding: 30px;
		position: relative;
		text-align: center;
		transition: all 0.5s ease-in-out;
	}
	.card.popular {
		margin-top: -10px;
		margin-bottom: -10px;
	}
	.card.popular .card-title h3 {
		color: #3498db;
		font-size: 22px;
	}
	.card.popular .card-price {
		margin: 50px;
	}
	.card.popular .card-price h1 {
		color: #3498db;
		font-size: 60px;
	}
	.card.popular .card-action button {
		background-color: #3498db;
		border-radius: 80px;
		color: #fff;
		font-size: 17px;
		margin-top: -15px;
		padding: 15px;
		height: 80px;
	}
	.card.popular .card-action button:hover {
		background-color: #2386c8;
		font-size: 23px;
	}
	.card:hover {
		box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
	}

	.card-ribbon {
		position: absolute;
		overflow: hidden;
		top: -10px;
		left: -10px;
		width: 114px;
		height: 112px;
	}
	.card-ribbon span {
		position: absolute;
		display: block;
		width: 160px;
		padding: 10px 0;
		background-color: #3498db;
		box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
		color: #fff;
		font-size: 13px;
		text-transform: uppercase;
		text-align: center;
		left: -35px;
		top: 25px;
		transform: rotate(-45deg);
	}
	.card-ribbon::before, .card-ribbon::after {
		position: absolute;
		z-index: -1;
		content: "";
		display: block;
		border: 5px solid #2980b9;
		border-top-color: transparent;
		border-left-color: transparent;
	}
	.card-ribbon::before {
		top: 0;
		right: 0;
	}
	.card-ribbon::after {
		bottom: 0;
		left: 0;
	}

	.card-title h3 {
		color: rgba(0, 0, 0, 0.3);
		font-size: 15px;
		text-transform: uppercase;
	}
	.card-title h4 {
		color: rgba(0, 0, 0, 0.6);
	}

	.card-price {
		margin: 60px 0;
	}
	.card-price h1 {
		font-size: 46px;
	}
	.card-price h1 sup {
		font-size: 15px;
		display: inline-block;
		margin-left: -20px;
		width: 10px;
	}
	.card-price h1 small {
		color: rgba(0, 0, 0, 0.3);
		display: block;
		font-size: 11px;
		text-transform: uppercase;
	}

	.card-description ul {
		display: block;
		list-style: none;
		margin: 60px 0;
		padding: 0;
	}
	.card-description li {
		color: rgba(0, 0, 0, 0.6);
		font-size: 15px;
		margin: 0 0 15px;
	}
	.card-description li::before {
		content: "✔";
		padding: 0 5px 0 0;
		color: rgba(0, 0, 0, 0.15);
	}

	.card-action button {
		background: transparent;
		border: 2px solid #3498db;
		border-radius: 30px;
		color: #3498db;
		cursor: pointer;
		display: block;
		font-size: 15px;
		font-weight: bold;
		padding: 10px;
		width: 100%;
		text-transform: uppercase;
		transition: all 0.3s ease-in-out;
	}
	.card-action button:hover {
		background-color: #3498db;
		box-shadow: 0 2px 4px #196090;
		color: #fff;
		font-size: 17px;
	}
</style>
<div class="wrapper-card">
	<div class="card">
		<div class="card-title">
			<h2 class="titlePack">Basic</h2>
			<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
		</div>
		<div class="card-price">
			<h1>
				<sup>$</sup>
				12
				<small>month</small>
			</h1>
		</div>
		<div class="card-description">
			<ul>
				<li>Lorem ipsum dolor sit amet</li>
				<li>Pellentesque hendrerit</li>
				<li>Aliquam at orci aliquam</li>
				<li>Praesent non sapien laoreet</li>
			</ul>
		</div>
		<div class="card-action">
			<button type="button">Register</button>
		</div>
	</div>
	<div class="card popular">

		<div class="card-title">
			<h2 class="titlePack">Pro</h2>
			<h4>Maecenas ut justo molestie, pharetra arcu ac, mollis est.</h4>
		</div>
		<div class="card-price">
			<h1>
				<sup>$</sup>
				15
				<small>month</small>
			</h1>
		</div>
		<div class="card-description">
			<ul>
				<li>Lorem ipsum dolor sit amet</li>
				<li>Pellentesque hendrerit</li>
				<li>Aliquam at orci aliquam</li>
				<li>Praesent non sapien laoreet</li>
			</ul>
		</div>
		<div class="card-action">
			<button type="button">Register</button>
		</div>
	</div>
	<div class="card">
		<div class="card-title">
			<h2 class="titlePack">Premium</h2>
			<h4>Duis quis sem auctor, convallis felis vitae, placerat sapien.</h4>
		</div>
		<div class="card-price">
			<h1>
				<sup>$</sup>
				20
				<small>month</small>
			</h1>
		</div>
		<div class="card-description">
			<ul>
				<li>Lorem ipsum dolor sit amet</li>
				<li>Pellentesque hendrerit</li>
				<li>Aliquam at orci aliquam</li>
				<li>Praesent non sapien laoreet</li>
			</ul>
		</div>
		<div class="card-action">
			<button type="button">Register</button>
		</div>
	</div>
</div>
