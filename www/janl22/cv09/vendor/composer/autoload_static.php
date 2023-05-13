<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9793e536af0ec0d91deec36296525f4c {
	public static $prefixLengthsPsr4 = array(
		'F' =>
			array(
				'Firebase\\JWT\\' => 13,
			),
	);

	public static $prefixDirsPsr4 = array(
		'Firebase\\JWT\\' =>
			array(
				0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
			),
	);

	public static $classMap = array(
		'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
	);

	public static function getInitializer(ClassLoader $loader) {
		return \Closure::bind(function () use ($loader) {
			$loader->prefixLengthsPsr4 = ComposerStaticInit9793e536af0ec0d91deec36296525f4c::$prefixLengthsPsr4;
			$loader->prefixDirsPsr4 = ComposerStaticInit9793e536af0ec0d91deec36296525f4c::$prefixDirsPsr4;
			$loader->classMap = ComposerStaticInit9793e536af0ec0d91deec36296525f4c::$classMap;

		}, null, ClassLoader::class);
	}
}