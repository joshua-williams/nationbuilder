module.exports = function(grunt){
	
	grunt.initConfig({
		copy: {
			adminlte: {
				files:[
					{expand: true, cwd: 'bower_components/AdminLTE', src:'plugins/**', dest:'public'},
					{expand: true, cwd: 'bower_components/AdminLTE/dist', src: '**', dest: 'public/adminlte'},
					{expand: true, cwd: 'bower_components/AdminLTE', src:'bootstrap/**', dest: 'public/plugins'}
				]
			}
		}
	});
	
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.registerTask('default', ['copy']);
}