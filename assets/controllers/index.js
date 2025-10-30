import { application } from '@symfony/stimulus-bridge';
import { definitionsFromContext } from '@symfony/stimulus-bridge';

const context = require.context('./', true, /\.js$/);
application.load(definitionsFromContext(context));
