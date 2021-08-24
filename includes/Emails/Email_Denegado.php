<?php
	$Motivos = [
		'Imágenes inválidas',
		'Datos inválidos',
		'Usuario no correspondiente'
	];
?>

<!DOCTYPE html>
<html lang="en" >
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<body link="#156E12" vlink="#156E12" alink="#156E12">
			<table class=" main contenttable" align="center" style="font-weight: normal;border-collapse: collapse;border: 0;margin-left: auto;margin-right: auto;padding: 0;font-family: Arial, sans-serif;color: #555559;background-color: white;font-size: 16px;line-height: 26px;width: 600px;">
				<tr>
					<td class="border" style="border-collapse: collapse;border: 1px solid #eeeff0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
						<table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
							<tr>
								<td colspan="4" valign="top" class="image-section" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background-color: #fff;border-bottom: 4px solid #156E12">
									<a href="https://www.caemc.com.ar/"><img class="top-image" src="" style="line-height: 1;width: 600px;" alt="Cooperativa Agropecuaria y de Electricidad Monte Caseros"></a>
								</td>
							</tr>
							<tr>
								<td valign="top" class="side title" style="border-collapse: collapse;border: 0;margin: 0;padding: 20px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;vertical-align: top;background-color: white;border-top: none;">
									<table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
										<tr>
											<td class="head-title" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 28px;line-height: 34px;font-weight: bold; text-align: center;">
												<div class="mktEditable" id="main_title">
													Verificación denegada
												</div>
											</td>
										</tr>
										<tr>
											<td class="top-padding" style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;"></td>
										</tr>
										<tr>
											<td class="top-padding" style="border-collapse: collapse;border: 0;margin: 0;padding: 15px 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 21px;">
												<hr size="1" color="#eeeff0">
											</td>
										</tr>

										<tr>
											<td class="text" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
												<div class="mktEditable" id="main_text">
													¡Hola!<br><br>
													Te informamos que lamentablemente los datos personales que ingresaste fueron denegados por las siguientes razones:
													<br>
													<ul>
														<?php 
															foreach($Opciones as $Index) {
																echo "<li>" . $Motivos[$Index - 1] . "</li>";
															}
														?>
													</ul>
													Por lo tanto, no podrás ingresar a todas las funciones del sitio. 
													<br><br>
													Tén en cuenta que puedes volver a presentar los datos correspondientes hasta dos veces más (límite de 3 veces).
												</div>
											</td>
										</tr>
										<tr>
											<td style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 24px;">
												&nbsp;<br>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td valign="top" align="center" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #49CB44;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
									<table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
										<tr>
											<td align="center" valign="middle" class="social" style="border-collapse: collapse;border: 0;margin: 0;padding: 10px;-webkit-text-size-adjust: none;color: #49CB44;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;text-align: center;">
												<table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
													<tr>
														<td style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #49CB44;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;"><a href="https://www.facebook.com/cooperativamontecaseros1977/"><img src="https://info.tenable.com/rs/tenable/images/facebook-teal.png"></a></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr bgcolor="#fff" style="border-top: 4px solid #156E12;">
								<td valign="top" class="footer" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #49CB44;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background: #fff;text-align: center;">
									<table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
										<tr>
											<td class="inside-footer" align="center" valign="middle" style="border-collapse: collapse;border: 0;margin: 0;padding: 20px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 12px;line-height: 16px;vertical-align: middle;text-align: center;width: 580px;">
												<div id="address" class="mktEditable">
													<b>Cooperativa Agropecuaria y de Electricidad Monte Caseros</b><br>
													Juan Pujol 2310<br>  3220 <br> Corrientes<br>
												</div>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
	</body>
	</body>
</html>