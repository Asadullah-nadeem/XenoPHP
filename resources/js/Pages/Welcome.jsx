import { Head } from '@inertiajs/react';

export default function Welcome() {
  return (
    <>
      <Head title="Welcome" />
      <div className="flex items-center justify-center min-h-screen bg-gray-50 dark:bg-dark-bg text-gray-900 dark:text-gray-100 selection:bg-primary-500 selection:text-white relative overflow-hidden">
        {/* Background Gradient Blob */}
        <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 -z-10 w-[800px] h-[800px] bg-primary-500/20 rounded-full blur-3xl opacity-30 animate-pulse"></div>

        <div className="text-center px-6 z-10">
          <h1 className="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 animate-slide-up">
            Welcome to <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-pink-600">XenoPHP + Vite</span>
          </h1>
          <p className="text-xl md:text-2xl text-gray-500 dark:text-gray-400 animate-slide-up [animation-delay:0.2s]">
            Simple. Fast. Secure.
          </p>
        </div>
      </div>
    </>
  );
}
