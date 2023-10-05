<section class="bg-eblu-900 -mt-14">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                  Accedi all'area fornitore
              </h1>
              <?php 
              echo form_open('accedi/login', array('class' => 'space-y-4 md:space-y-6')); 
              ?>
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Codice fornitore</label>
                      <input type="number" name="codforn" id="codforn" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Il tuo codice fornitore" required="">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " required="">
                  </div>
                  <div class="flex items-center justify-between">
                      <a href="<?php echo site_url('accedi/recupero'); ?>" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Password dimenticata?</a>
                  </div>
                  <button type="submit" class="w-full text-white bg-eblu-900 hover:bg-eblu-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Accedi</button>
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                      Non hai un account? <a href="<?php echo site_url('registrati'); ?>" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Registrati</a>
                  </p>
              </form>
          </div>
      </div>
  </div>
</section>