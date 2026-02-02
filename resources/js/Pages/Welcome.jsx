import { Head } from '@inertiajs/react';

export default function Welcome() {
  return (
    <>
      <Head title="Backend" />
      <div className="flex items-center justify-center min-h-screen bg-gray-50 dark:bg-dark-bg text-gray-900 dark:text-gray-100 selection:bg-primary-500 selection:text-white">
        <div className="text-center px-6">
          <h1 className="text-5xl font-extrabold tracking-tight mb-4">
            Welcome to XenoPHP Backend...
          </h1>
        </div>
      </div>
    </>
  );
}
