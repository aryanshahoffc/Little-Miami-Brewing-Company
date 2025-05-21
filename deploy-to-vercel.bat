@echo off
echo Installing Vercel CLI...
npm install -g vercel

echo Building Next.js application...
npm install
npm run build

echo Deploying to Vercel...
vercel --prod

echo Deployment complete! Visit your site at: https://littlemiamibrewing.vercel.app
pause
