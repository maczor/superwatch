<?php

class BrandsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('brands')->truncate();

		$brands = array(
			['name'=>'Ardath', 'logo'=>'ardath.png', 'width'=>98, 'height'=>40, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Arnold & Son', 'logo'=>'arnold_and_son.png', 'width'=>119, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Audemars Piguet', 'logo'=>'audemars_piguet.png', 'width'=>146, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Baume et Mercier', 'logo'=>'baume_et_mercier.png', 'width'=>162, 'height'=>20, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Bell and Ross', 'logo'=>'bell_and_ross.png', 'width'=>122, 'height'=>47, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Blancpain', 'logo'=>'blancpain.png', 'width'=>163, 'height'=>36, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Bombardier', 'logo'=>'bombardier.png', 'width'=>86, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Boucheron', 'logo'=>'boucheron.png', 'width'=>122, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Breguet', 'logo'=>'breguet.png', 'width'=>94, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Breitling', 'logo'=>'breitling.png', 'width'=>138, 'height'=>53, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Bucherer', 'logo'=>'bucherer.png', 'width'=>163, 'height'=>20, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Bulgari', 'logo'=>'bulgari.png', 'width'=>163, 'height'=>15, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Cartier', 'logo'=>'cartier.png', 'width'=>121, 'height'=>33, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Chanel', 'logo'=>'chanel.png', 'width'=>163, 'height'=>25, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Chopard', 'logo'=>'chopard.png', 'width'=>160, 'height'=>57, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Chronographe Suisse', 'logo'=>'chronographe_suisse.png', 'width'=>139, 'height'=>30, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Corum', 'logo'=>'corum.png', 'width'=>113, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Daniel Jean Richard', 'logo'=>'danieljeanrichard.png', 'width'=>152, 'height'=>52, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Ebel', 'logo'=>'ebel.png', 'width'=>104, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Eberhard', 'logo'=>'eberhard.png', 'width'=>164, 'height'=>54, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'F.P. Journe', 'logo'=>'fp_journe.png', 'width'=>134, 'height'=>43, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Franck Muller', 'logo'=>'franck_muller.png', 'width'=>163, 'height'=>42, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Fred, Paris', 'logo'=>'fred_paris.png', 'width'=>128, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Girard Perregaux', 'logo'=>'girard_perregaux.png', 'width'=>164, 'height'=>35, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Graham', 'logo'=>'graham.png', 'width'=>161, 'height'=>40, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Hamilton', 'logo'=>'hamilton.png', 'width'=>163, 'height'=>20, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Hermès', 'logo'=>'hermes.png', 'width'=>101, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Heuer', 'logo'=>'heuer.png', 'width'=>108, 'height'=>56, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Hublot', 'logo'=>'hublot.png', 'width'=>77, 'height'=>59, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'IWC', 'logo'=>'iwc.png', 'width'=>93, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Jaeger-LeCoultre', 'logo'=>'jaeger-lecoultre.png', 'width'=>164, 'height'=>40, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Jean Richard', 'logo'=>'jean_richard.png', 'width'=>155, 'height'=>56, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Kelton', 'logo'=>'kelton.png', 'width'=>122, 'height'=>22, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Le Cheminant', 'logo'=>'le_cheminant.png', 'width'=>152, 'height'=>27, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Le Coultre', 'logo'=>'lecoultre.png', 'width'=>117, 'height'=>46, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'LIP', 'logo'=>'lip.png', 'width'=>38, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Longines', 'logo'=>'longines.png', 'width'=>163, 'height'=>40, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Mauboussin', 'logo'=>'mauboussin.png', 'width'=>163, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Montblanc', 'logo'=>'montblanc.png', 'width'=>100, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Movado', 'logo'=>'movado.png', 'width'=>163, 'height'=>40, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Officine Panerai', 'logo'=>'officine.png', 'width'=>163, 'height'=>44, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Omega', 'logo'=>'omega.png', 'width'=>118, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Orwa', 'logo'=>'orwa.png', 'width'=>122, 'height'=>35, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Others', 'logo'=>'others.png', 'width'=>82, 'height'=>18, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Panerai', 'logo'=>'panerai.png', 'width'=>140, 'height'=>34, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Patek Philippe', 'logo'=>'patek_philippe.png', 'width'=>132, 'height'=>63, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Piaget', 'logo'=>'piaget.png', 'width'=>156, 'height'=>55, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Pontiac', 'logo'=>'pontiac.png', 'width'=>141, 'height'=>38, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Porsche Design', 'logo'=>'porsche_design.png', 'width'=>163, 'height'=>7, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Raidillon', 'logo'=>'raidillon.png', 'width'=>163, 'height'=>32, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Rolex', 'logo'=>'rolex.png', 'width'=>97, 'height'=>53, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Shellman & Co.', 'logo'=>'shellmanandco.png', 'width'=>158, 'height'=>16, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Snyper', 'logo'=>'snyper.png', 'width'=>157, 'height'=>13, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Tag Heuer', 'logo'=>'tagheuer.png', 'width'=>124, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Tiffany & Co', 'logo'=>'tiffany_and_co.png', 'width'=>163, 'height'=>20, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Tissot', 'logo'=>'tissot.png', 'width'=>126, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Tudor by ROLEX', 'logo'=>'tudor.png', 'width'=>104, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Universal Geneve', 'logo'=>'universal_geneve.png', 'width'=>111, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Vacheron Constantin', 'logo'=>'vacheron_constantin.png', 'width'=>163, 'height'=>36, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Wittnauer', 'logo'=>'wittnauer.png', 'width'=>149, 'height'=>33, 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Zenith', 'logo'=>'zenith.png', 'width'=>145, 'height'=>58, 'created_at'=>new DateTime, 'updated_at' => new DateTime]
 		);

		// Uncomment the below to run the seeder
		DB::table('brands')->insert($brands);
	}

}
