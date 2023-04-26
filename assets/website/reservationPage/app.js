import './app.css';
import * as React from 'react';
import { createRoot } from 'react-dom/client';

import App from './reservationApp/App';

const root = createRoot(document.getElementById('reservationApp'));
root.render(<App/>);
